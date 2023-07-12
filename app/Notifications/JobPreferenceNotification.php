<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Blade;

class JobPreferenceNotification extends Notification
{
    use Queueable;

    private $tags, $template, $user_name;

   
    public function __construct($tags, $template, $user_name)
    {
        $this->tags = $tags;
        $this->template = $template;
        $this->user_name = $user_name;
    }

    
    public function via($notifiable)
    {
        return ['mail'];
    }

   
    public function toMail($notifiable)
    {
        try{
            return (new MailMessage)
            ->subject("LMIS New Job Created")
            ->line(Blade::render(
                $this->template,
                [
                    'user_name' => $this->user_name,
                    'tags'       => $this->tags,
                ]
            ));
        }catch(Exception $e){
            Log::error($e);
        }
    }

}
