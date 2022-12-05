<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Blade;

use NotificationChannels\Fcm\FcmChannel;
use NotificationChannels\Fcm\FcmMessage;
use NotificationChannels\Fcm\Resources\AndroidConfig;
use NotificationChannels\Fcm\Resources\AndroidFcmOptions;
use NotificationChannels\Fcm\Resources\AndroidNotification;
use NotificationChannels\Fcm\Resources\ApnsConfig;
use NotificationChannels\Fcm\Resources\ApnsFcmOptions;
use Exception;

use Illuminate\Support\Facades\Log;


class UserSignupNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $notificationData;
    private $template;
    private $inApp;
    private $subject;
    private $buttons;

    public function __construct($notificationData, $template, $InApp, $subject,$buttons)
    {
        $this->notificationData = $notificationData;
        $this->template = $template;
        $this->inApp = $InApp;
        $this->subject = $subject;
        $this->buttons = $buttons;

    }

   
    public function via($notifiable)
    {
        return ['mail','database'];
    }

    
    public function toMail($notifiable)
    {
        Log::info($this->notificationData);

        try{
            return (new MailMessage)
            ->subject($this->subject)
            ->line(Blade::render(
                $this->template,
                ['notificationData' => $this->notificationData,
                 'buttons'       => $this->buttons,
                ]
            ));
        }catch(Exception $e){
            Log::error($e);
        }

        
    }

   
    public function toArray($notifiable)
    {
        Log::info("to array");
        return [
            'subject' => $this->inApp['subject'],
            'body'    => $this->inApp['body'],
            'action'  => $this->inApp['action']
        ];
    }
}
