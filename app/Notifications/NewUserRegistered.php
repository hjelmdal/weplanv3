<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\URL;

class NewUserRegistered extends Notification
{
    use Queueable;
    private $channel;
    private $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {

        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action(__('Verify Email Address'),
                        URL::temporarySignedRoute(
                            'verification.verify',
                            Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
                            ['id' => $notifiable->id]
                        ))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }

    /**
     * Get the Slack representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return SlackMessage
     */
    public function toSlack($notifiable)
    {
        $url = url('/nova/resources/users/'. $notifiable->id);
        $this->user = $notifiable;
        if($notifiable->facebook) {
            $this->channel = "Facebook";
        } elseif($notifiable->google) {
            $this->channel = "Google";
        } else {
            $this->channel = "WePlan";
        }
        return (new SlackMessage)
            ->success()
            ->from('WePlan')
            ->image('https://dev.v3.weplan.dk/img/webapp/weplan-64x64.png')
            ->content('New user has signed up!')
            ->attachment(function ($attachment) use ($url) {
                $attachment->title('Go to dashboard', $url)
                    ->fields([
                        'Name' => $this->user->name,
                        'Channel' => $this->channel,
                        'Email' => $this->user->email,
                        'Time' => $this->user->created_at

                    ]);
            });
    }
}
