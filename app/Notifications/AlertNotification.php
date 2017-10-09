<?php

namespace App\Notifications;

use App\Alert;
use App\Services\Alerts\ReportService;
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
        $service = new ReportService();
        $url = $service->getReportUrlForTodayAlert($this->alert);

        return (new MailMessage())
            ->subject('Nueva publicación oficial')
            ->greeting('Alerta de nuevo contenido')
            ->line('Se han publicado nuevos contenidos de tu interés. Pincha en el siguiente enlace para acceder al reporte.')
            ->action('Ver reporte', $url)
            ->salutation('Gracias por confiar en nosotros!');
    }
}
