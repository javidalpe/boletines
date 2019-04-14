<?php

namespace App\Notifications;

use App\Channels\WebhookChannel;
use App\Services\Alerts\AlertResult;
use App\Services\Alerts\ReportService;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class MultipleAlertNotification extends Notification
{
    use Queueable;

    /**
     * @var AlertResult[]
     */
    public $alertsResults;

    /**
     * MultipleAlertNotification constructor.
     * @param AlertResult[] $alerts
     */
    public function __construct($alerts)
    {
        $this->alertsResults = $alerts;
    }


    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', WebhookChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $service = new ReportService();

        $mail = (new MailMessage())
            ->success()
            ->greeting('¡Hola!');

        if (count($this->alertsResults) > 1) {
            $mail->subject('Tenemos varias alertas para ti')
                ->line("Hemos encontrado varios términos en los boletines oficiales.");

            foreach ($this->alertsResults as $alertResult) {
                $url = $service->getReportUrlForTodayAlert($alertResult->getAlert());
                $mail = $mail->line(sprintf('El término -%s- ha aparecido en los siguientes boletines:',
                    $alertResult->getQuery()))
                    ->line($url);
            }
        } else {
            $firstResult = $this->alertsResults[0];
            $url = $service->getReportUrlForTodayAlert($firstResult->getAlert());
            $mail->subject('Tenemos una alerta para ti')
                ->line(sprintf('Hemos encontrado el término -%s- en al menos uno de los boletines oficiales.',
                    $firstResult->getQuery()))
                ->action('Ver boletines', $url);
        }

        return $mail->line(sprintf('Podrás gestionar tus alertas desde el área privada de %s.', config('app.name')))
            ->salutation('Saludos del equipo');
    }

    /**
     * @return false|string
     */
    public function toWebhook()
    {
        $service = new ReportService();
        $results = [];
        foreach ($this->alertsResults as $alertResult) {
            $url = $service->getReportUrlForTodayAlert($alertResult->getAlert());
            $results[] = [
                'query' => $alertResult->getQuery(),
                'fragments' => $alertResult->getFragments(),
                'frequency' => $alertResult->getFrequency(),
                'report' => $url
            ];
        }

        return json_encode([
            'alerts' => $results
        ]);
    }
}
