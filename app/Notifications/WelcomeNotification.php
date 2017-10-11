<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class WelcomeNotification extends Notification
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
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject(sprintf("Bienvenido a %s", config('app.name')))
            ->greeting(sprintf("Bienvenido a %s!", config('app.name')))
            ->line('Te has registrado correctamente.')
            ->line(sprintf('El objetivo de %s es permitirte buscar cada día en todos los boletines oficiales de 
            España y crear alertas para aquellos términos que te interesan (un nombre, empresa, DNI, NIF, sector, 
            matricula oposiciñon...).', config('app.name')))
            ->action("Crea tu primera alerta", route('alerts.create'))
            ->salutation("Saludos del equipo");
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
