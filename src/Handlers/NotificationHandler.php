<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Handlers;

use PHPMailer\PHPMailer\PHPMailer;
use \Slim\Views\PhpRenderer;
/**
 * NotificationHandler send notification by email to recipient
 *
 * @author pmc
 */
class NotificationHandler
{

    protected $mail;

    protected $renderer;
    protected $logger;

    protected $settings;

    protected $useMock = true;

    public function __construct($settings, PhpRenderer $renderer)
    {
        $this->mail = new PHPMailer(true);
        $this->renderer = $renderer;

        $this->mail->isSMTP();
        $this->mail->Host = $settings['SMTP_SRV'];         // Specify main and backup SMTP servers
        $this->mail->SMTPAuth = true;                         // Enable SMTP authentication
        $this->mail->Username = $settings['SMTP_USER'];  // SMTP username
        $this->mail->Password = $settings['SMTP_PWD'];            // SMTP password
        $this->mail->SMTPSecure = 'tls';                      // Enable TLS encryption, `ssl` also accepted
        $this->mail->Port = 587;                              // TCP port to connect to
        $this->mail->SMTPOptions = array(
            'ssl' => array(
                'allow_self_signed' => true,
                'peer_name' => 'smtp.gmail.com'
            )
        );
        $this->mail->setFrom('noreply.pourmiam@gmail.com', 'Pourmiam');

        $this->useMock = ($settings['SMTP_USE_MOCK'] == 'true') ? true : false;

        $this->settings = $settings;
    }

    protected function notify(string $userMail, string $subject, string $mailText, bool $isHTML = null)
    {
        if (!$this->useMock) {
            //Recipients
            $this->mail->addAddress($userMail);

            //Content
            $this->mail->isHTML($isHTML);                                  // Set email format to HTML
            $this->mail->Subject = $subject;
            $this->mail->Body = $mailText;

            $this->mail->send();
        }
    }

    public function notifyInit(string $userMail, string $token)
    {
        $args = array("token" => $token);
        $mailTxt = $this->renderer->fetch('mail_for_init.ptxt', $args);
        $this->notify($userMail, "PourMiam' Account Creation", $mailTxt);
    }

    public function notifyReset(string $userMail, string $token)
    {
        $args = array("token" => $token);
        $mailTxt = $this->renderer->fetch('mail_for_reset.ptxt', $args);
        $this->notify($userMail, "PourMiam' Account Reset", $mailTxt);
    }
}
