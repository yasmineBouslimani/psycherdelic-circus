<?php


namespace App\Service;


use App\Entity\Customer;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Twig\Environment;
use Symfony\Component\HttpFoundation\Request;

class Newsletter
{

    protected $mailer;
    private $templating;


    public function __construct(MailerInterface $mailer, Environment $templating)
    {
        $this->mailer = $mailer;
        $this->templating = $templating;
    }

    public function sendContactEmail($from, $to, $customer, $view)
    {
        $email = new Email();
        $email
            ->from($from)
            ->to($to)
            ->subject('Une nouvelle série vient d\'être publiée')
            ->html($this->templating->render($view, ['customer' => $customer]));

        $this->mailer->send($email);
    }

}
