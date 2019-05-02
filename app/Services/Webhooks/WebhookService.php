<?php

namespace App\Services\Webhooks;

use App\Services\Scrapers\Http\HttpService;
use App\Webhook;
use Carbon\Carbon;
use GuzzleHttp\Exception\GuzzleException;

class WebhookService
{

    public function sendToWebhook(Webhook $webhook, $content)
    {

        try {
            $response = HttpService::post($webhook->url, $content);

            $webhook->last_notification_response_body = $response->getBody()->getContents();
            $statusCode = $response->getStatusCode();
            $webhook->last_notification_response_code = $statusCode;
            $webhook->status = $statusCode !== 200 ? Webhook::STATUS_WARNING : Webhook::STATUS_OK;
        } catch (GuzzleException $e) {
            $webhook->last_notification_response_body = null;
            $webhook->last_notification_response_code = null;
            $webhook->status = Webhook::STATUS_ERROR;
        }

        $webhook->last_notification_request_body = $content;
        $webhook->last_notification_at = Carbon::now();
        $webhook->save();
    }
}
