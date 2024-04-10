<?php

namespace App\Services;

use SendGrid;
use SendGrid\Mail\Mail;


class SendGridService
{
    protected $sendgrid;

    public function __construct()
    {
        $this->sendgrid = new SendGrid(env('SENDGRID_API_KEY'));
    }

    public function send($to, $subject, $htmlContent)
    {
        $email = new Mail();
        $email->setFrom("jmendezmendez056@gmail.com", "UNILAB");
        $email->setSubject($subject);
        $email->addTo($to);
        $email->addContent("text/html", $htmlContent);

        try {
            $response = $this->sendgrid->send($email);
            return $response->statusCode();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
