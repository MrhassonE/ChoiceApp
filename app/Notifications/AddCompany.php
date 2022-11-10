<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Kutia\Larafirebase\Facades\Larafirebase;

class AddCompany extends Notification
{
    use Queueable;
    public $name;
    public $data;

    /**
     * Create a new notification instance.
     *
     * @param $name
     * @param $data
     */
    public function __construct($name,$data)
    {
        $this->name = $name;
        $this->data = $data;
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
        return Larafirebase::withTitle(' مرحبا ')
            ->withBody('تم اضافة شركة جديدة بأسم '.$this->name)
            ->withAdditionalData(['Co'=>$this->data])
            ->sendNotification([$notifiable->fcm_token]);
    }
}
