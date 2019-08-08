<?php

namespace App\Notifications;

use App\Helpers\Helpers;
use App\Http\Controllers\API\Auth\UserAPI;
use App\Models\UserActivation;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
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
        return ['mail','slack'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {

        $code = Helpers::codeGen()->setUserActivationCode($notifiable);
        $regFormat = $code["formatted"];



        return (new MailMessage)
            ->subject("Aktiveringskode til WePlan: ". $regFormat)
            ->greeting('Hej '. $notifiable->name . "!")
            ->line('Vi er glade for at byde dig velkommen til WePlan.dk')
            ->line("For at kunne bruge applikationen skal du gøre din profil færdig. Først skal vi sikre os, at du ejer denne mail adresse, som du bedes bekræfte nedenfor. Du kan enten taste aktiveringskoden vist i emnefeltet samt nedenfor i vores applikation, eller du kan trykke på knappen nedenfor.")
            ->action(__('Bekræft Email Addresse'),
                URL::temporarySignedRoute(
                    'verification.verify',
                    Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
                    ['id' => $notifiable->id]
                ))
            ->line('Endnu engang TAK for din registrering og velkommen til WePlan!')
            ->salutation("Sportslige hilsner fra ". config('app.name') . " Teamet! :-)");
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
