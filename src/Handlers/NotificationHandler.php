<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Handlers;

use PHPMailer\PHPMailer\PHPMailer;

/**
 * NotificationHandler send notification by email to recipient
 *
 * @author pmc
 */
class NotificationHandler
{

    protected $mail;

    protected $renderer;

    protected $settings;

    protected $useMock = true;

    public function __construct($settings, \Slim\Views\PhpRenderer $renderer)
    {
        $this->mail = new PHPMailer(true);
        $this->renderer = $renderer;

        $this->mail->isSMTP();
        $this->mail->Host = $settings['SMTP_SRV'];                // Specify main and backup SMTP servers
        $this->mail->SMTPAuth = true;                             // Enable SMTP authentication
        $this->mail->Username = $settings['SMTP_USER'];           // SMTP username
        $this->mail->Password = $settings['SMTP_PWD'];
        //  Si on utilise SSL
        if ($settings['SMTP_USE_SSL'] != "false") {
            $this->mail->SMTPSecure = 'tls';                      // Enable TLS encryption, `ssl` also accepted
            $this->mail->Port = 587;                              // TCP port to connect to
            $this->mail->SMTPOptions = [
                'ssl' => [
                    'allow_self_signed' => true,
                    'peer_name' => $settings['SMTP_SRV'],
                    'verify_peer' => ($settings['SMTP_VERIFY_PEER'] != "false") ? true : false,
                    'verify_peer_name' => ($settings['SMTP_VERIFY_PEER'] != "false") ? true : false,
                ],
            ];
        }
        $this->mail->setFrom('noreply.pourmiam@gmail.com', "PourMiam'");

        $this->useMock = ($settings['SMTP_USE_MOCK'] == 'true') ? true : false;

        $this->settings = $settings;
    }

    public function notifyInit(string $userMail, string $token)
    {
        $urlApiConfirm = $this->settings['scheme'] . $this->settings['hostName'] . $this->settings['apiPath'] .
                         "authent/init/$token/confirm";
        $args = ["urlApiConfirm" => $urlApiConfirm];
        $mailTxt = $this->renderer->fetch('mail_for_init.ptxt', $args);
        $this->notify($userMail, "Creation de compte PourMiam'", $mailTxt);
    }

    /**
     * function notify : send email notification to user
     *
     * @param type string $userMail
     * @param type string $mailText
     */
    protected function notify(
        string $userMail,
        string $subject,
        string $mailText,
        bool $isHTML = null
    ) {
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

    public function notifyReset(string $userMail, string $token)
    {
        $urlApiConfirm = $this->settings['scheme'] . $this->settings['hostName'] . $this->settings['apiPath'] .
                         "authent/reset/$token/confirm";
        $args = ["urlApiConfirm" => $urlApiConfirm];
        $mailTxt = $this->renderer->fetch('mail_for_reset.ptxt', $args);
        $this->notify($userMail, "Reset du mot de passe de votre compte PourMiam'", $mailTxt);
    }
}
