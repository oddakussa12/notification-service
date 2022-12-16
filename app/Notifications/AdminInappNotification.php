<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminInappNotification extends Notification
{
    use Queueable;

    private $subject, $body;
   
    public function __construct($subject, $body)
    {
        $this->subject = $subject;
        $this->body = $body;
    }

   
    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'subject' => $this->subject,
            'body'    => $this->body,
            // 'action'  => $this->inApp['action']
        ];
    }
}
