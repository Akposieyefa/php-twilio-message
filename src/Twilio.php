<?php

namespace Orutu\Otp;

use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Client;
use Orutu\Otp\DotEnv;

class Twilio 
{

    public function __construct()
    {
        (new DotEnv(__DIR__ . '/../.env'))->load();
        $this->client = new Client(getenv('TWILIO_SID'),getenv('TWILIO_AUTH_TOKEN'));
    }

    public function sendSms($receive)
    {
        $otp = $this->generateRandomOtp(6);
        try {
            $this->client->messages->create(
                $receive,
                [
                    'from' => getenv('TWILIO_FROM'),
                    'body' => "Use the otp code below $otp"
                ]
            );
            return true;
        } catch (\Exception $e) {
           var_dump($e->getMessage());
        }
    }

    public function generateRandomOtp($number)
    {
        $today = date('YmdHis');
        $characters = '0123456789';
        $main = $today."". $characters;
        $randomString = '';
        for ($i = 0; $i < $number; $i++) {
            $index = rand(0, strlen($main) - 1);
            $randomString .= $main[$index];
        }
        return $randomString;
    }

}