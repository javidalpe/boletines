<?php

namespace App\Notifications;

use App\Alert;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AlertNotification extends Notification
{
    use Queueable;

    private $alert;

    /**
     * AlertNotification constructor.
     * @param $alert
     */
    public function __construct(Alert $alert)
    {
        $this->alert = $alert;
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
        $now = Carbon::now();
        $url = route('report', ['id' => $this->alert, 'timestamp' => $now->timestamp]);

        $mail = new MailMessage();
        $mail->greeting('Alerta de contenido oficial')
            ->line('Se han publicado las siguientes novedades según tus ofertas:')
            ->action('Ver reporte', $url)
            ->line('Gracias por confiar en nosotros!');

        return $mail;
    }
}
