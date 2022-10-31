<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactUsForm extends Mailable
{
    use Queueable, SerializesModels;
    public $name;
    public $email;
    public $message;

    /**
     * Create a new message instance.
     *
     * @param $name
     * @param $email
     * @param $message
     */
    public function __construct($name,$email,$message)
    {
        $this->name= $name;
        $this->email= $email;
        $this->message= $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('Dashboard.mailContact')->with([
            'name'=>$this->name,
            'email'=>$this->email,
            'message'=>$this->message,
        ]);
    }
}
