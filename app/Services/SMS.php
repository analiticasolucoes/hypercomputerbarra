<?php

namespace app\Services;

use Twilio\Rest\Client as TwilioClient;

class SMS
{
    private TwilioClient $twilioClient;
    private string $twilioPhone;

    public function __construct()
    {
        $twilioAccountID = getenv("TWILIO_ACCOUNT_SID");
        $twilioAuthToken = getenv("TWILIO_AUTH_TOKEN");
        $this->twilioPhone = getenv("TWILIO_NUMBER");

        require_once realpath(__DIR__ . '/..') . '/Src/Twilio/autoload.php';

        $this->twilioClient = new TwilioClient($twilioAccountID, $twilioAuthToken);
    }

    public function send(string $to, string $messageContent): bool|int
    {
        try {
            $message = $this->twilioClient->messages->create(
                $to,
                array(
                'from' => $this->twilioPhone,
                'body' => $messageContent
            ));
            return $message->sid;
        } catch (\Exception $e) {
            echo "Erro ao enviar mensagem: " . $e->getMessage();
            return false;
        }
    }
}