<?php

namespace App\Notifications;

use App\Classes\NotificationType;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Fcm\FcmChannel;
use NotificationChannels\Fcm\FcmMessage;
use NotificationChannels\Fcm\Resources\AndroidConfig;
use NotificationChannels\Fcm\Resources\AndroidFcmOptions;
use NotificationChannels\Fcm\Resources\AndroidMessagePriority;
use NotificationChannels\Fcm\Resources\AndroidNotification;
use NotificationChannels\Fcm\Resources\ApnsConfig;
use NotificationChannels\Fcm\Resources\ApnsFcmOptions;
use NotificationChannels\Fcm\Resources\NotificationPriority;

class SendCustomNotificationToDriver extends Notification
{
    use Queueable;

    private $notificationRequest;
    private $photo;
    private $promotion_push_notification;
    private $last_change;


    public function __construct($notificationRequest, $photo, $last_change, $promotion_push_notification = true)
    {
        $this->notificationRequest = $notificationRequest;
        $this->promotion_push_notification = $promotion_push_notification;
        $this->photo = $photo;
        $this->last_change = $last_change;

    }

    public function via($notifiable)
    {
        if ($this->promotion_push_notification) {
            $array = [FcmChannel::class, 'database'];
        } else {
            $array = ['database'];
        }
        return $array;

    }

    public function toFcm($notifiable)
    {
        return FcmMessage::create()
            ->setData([
                'notification_id' => $this->id,
                'type' => NotificationType::$promotional,
                'title' => $this->notificationRequest['title_' . $this->last_change],
                'body' => $this->notificationRequest['body_' . $this->last_change],
                'photo' => $this->photo
            ])
            ->setNotification(\NotificationChannels\Fcm\Resources\Notification::create()
                ->setTitle('azhal: ' . $this->notificationRequest['title_' . $this->last_change]) //title_en or title_ar
                ->setBody($this->notificationRequest['body_' . $this->last_change]))//body_en or body_ar
            ->setAndroid(
                AndroidConfig::create()
                    ->setFcmOptions(AndroidFcmOptions::create()->setAnalyticsLabel('analytics'))
                    ->setNotification(
                        AndroidNotification::create()
                            ->setColor('#0A0A0A')
                            ->setNotificationPriority(NotificationPriority::PRIORITY_MAX())
                    )
                    ->setPriority(AndroidMessagePriority::HIGH())
            )->setApns(
                ApnsConfig::create()
                    ->setFcmOptions(ApnsFcmOptions::create()->setAnalyticsLabel('analytics_ios'))
            );
    }

    public function toArray($notifiable)
    {
        return [
            'title_ar' => $this->notificationRequest['title_ar'],
            'title_en' => $this->notificationRequest['title_en'],
            'body_ar' => $this->notificationRequest['body_ar'],
            'body_en' => $this->notificationRequest['body_en'],
            'photo' => $this->photo,
            'type' => NotificationType::$promotional
        ];
    }
}
