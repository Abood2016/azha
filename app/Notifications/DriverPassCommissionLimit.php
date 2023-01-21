<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DriverPassCommissionLimit extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $order_id;
    private $user;
    public function __construct($order_id,$user)
    {
       $this->order_id = $order_id;
       $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'title' => 'Pass Commission',
            'body' => 'Driver '.$this->user->name.' Pass Commission Limit ,his phone is '.$this->user->phone,
            'link' => '/orders/'.$this->order_id,
        ];
    }
}
