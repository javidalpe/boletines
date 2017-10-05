<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class YouHaveBeenInvitedNotification extends Notification
{
    use Queueable;

    private $user;

    /**
     * YouHaveBeenInvitedNotification constructor.
     * @param $user
     */
    public function __construct($user)
    {
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
                    ->subject(sprintf("Invitación a %s", config('app.name')))
                    ->greeting("Hola!")
                    ->line(sprintf("Tu amigo %s te ha invitado a registrarte en %s.", $this->user->name, config('app.url')))
                    ->line(sprintf("%s es una plataforma para buscar y supervisar los boletines oficiales del estado.", config('app.name')))
                    ->action('Crear una cuenta', route('register'))
                    ->salutation('Saludos');
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
}
