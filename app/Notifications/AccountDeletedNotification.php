<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AccountDeletedNotification extends Notification
{
    use Queueable;

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
            ->subject(sprintf("Baja del servicio %s", config('app.name')))
            ->greeting('¡Hola!')
            ->line(sprintf('Te escribimos este último mail para informarte que te hemos dado de baja de %s y 
            hemos borrado todos tus datos. Una vez enviado este mail, también quedará borrado el mismo sin opción de 
            recuperación.', config('app.name')))
            ->line('Si quieres activar otra vez el servicio tendrás que registrarte nuevamente.')
            ->salutation("Saludos del equipo");
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
