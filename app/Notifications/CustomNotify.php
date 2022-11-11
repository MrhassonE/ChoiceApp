<?php

namespace App\Notifications;

use http\Message\Body;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Kutia\Larafirebase\Facades\Larafirebase;

class CustomNotify extends Notification
{
    use Queueable;
    public $title;
    public $body;
    public $data;
    public $type;

    /**
     * Create a new notification instance.
     *
     * @param $title
     * @param $body
     * @param $data
     * @param $type
     */
    public function __construct($title,$body,$data,$type)
    {
        $this->title = $title;
        $this->body = $body;
        $this->data = $data;
        $this->type = $type;

    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['firebase'];
    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toFirebase($notifiable)
    {
        return Larafirebase::withTitle($this->title)
            ->withBody($this->body)
            ->withAdditionalData(['Ty'=>$this->type,'Cu'=>$this->data])
            ->sendNotification([$notifiable->fcm_token]);
    }
}
