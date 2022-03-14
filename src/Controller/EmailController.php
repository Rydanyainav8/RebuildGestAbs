<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Notifier\Notification\Notification;
use Symfony\Component\Notifier\NotifierInterface;
use Symfony\Component\Notifier\Recipient\Recipient;
use Symfony\Component\Routing\Annotation\Route;

class EmailController extends AbstractController
{
    #[Route('/email', name: 'app_email')]
    public function sendEmail(MailerInterface $mailer): Response
    {
        $email = (new Email())
            ->from('andriniaina.rakotondravao@esti.mg')
            ->to('rydanyaina@gmail.com')
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html('<p>See Twig integration for better HTML integration!</p>');
            
        $mailer->send($email);
        
        return $this->redirectToRoute('index');
    }

    #[Route('/notif', name: 'app_notif')]
    public function create(NotifierInterface $notifier): Response
    {
        // ...

        // Create a Notification that has to be sent
        // using the "email" channel
        $notification = (new Notification('New Invoice', ['email']))
            ->content('You got a new invoice for 15 EUR.');
        // The receiver of the Notification
        // $recipient = new Recipient(
        //     $user->getEmail(),
        //     $user->getPhonenumber()
        // );
  
        // Send the notification to the recipient
        $notifier->send($notification, new Recipient('rydanyaina@gmail.com'));

        return $this->redirectToRoute('index');
    }
}
