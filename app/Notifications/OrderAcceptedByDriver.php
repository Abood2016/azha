<?php

namespace App\Notifications;

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

class OrderAcceptedByDriver  extends Notification
{
    use Queueable;

    public $order_id;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($order_id)
{
    $this->order_id = $order_id;
}

    public function via($notifiable)
{
    return [FcmChannel::class];
}

    public function toFcm($notifiable)
{
    return FcmMessage::create()
        ->setData(['order_id' => strval($this->order_id),'type' => 'driver_on_the_way'])
        ->setNotification(\NotificationChannels\Fcm\Resources\Notification::create()
            ->setTitle('azhal: The driver in the way.')
            ->setBody('The driver in the way.'))
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
}
