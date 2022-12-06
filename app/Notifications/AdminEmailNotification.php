<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Blade;

class AdminEmailNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $template;
    private $subject;

    public function __construct($template, $subject)
    {
        $this->template = $template;
        $this->subject = $subject;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        // return (new MailMessage)
        //             ->line('The introduction to the notification.')
        //             ->action('Notification Action', url('/'))
        //             ->line('Thank you for using our application!');
        try{
            return (new MailMessage)
            ->subject($this->subject)
            ->line(Blade::render(
                $this->template,
                // ['notificationData' => $this->notificationData,
                //     'buttons'       => $this->buttons,
                // ]
            ));
        }catch(Exception $e){
            Log::error($e);
        }
    }
}
