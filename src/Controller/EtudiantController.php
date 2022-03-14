<?php

namespace App\Controller;

use App\Entity\AbsEtudiant;
use App\Entity\DepAntEtudiant;
use App\Entity\Etudiant;
use App\Entity\RetardEtudiant;
use App\Form\AbsenceEtType;
use App\Form\DepAntEtudiantType;
use App\Form\RetardEtudiantType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Symfony\Component\Notifier\Notification\Notification;
use Symfony\Component\Notifier\NotifierInterface;
use Symfony\Component\Notifier\Recipient\Recipient;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class EtudiantController extends AbstractController
{
    #[Route('/Etudiant/absence', name: 'absenceEtudiant')]
    public function absenceEtudiant(Request $req, EntityManagerInterface $em, SluggerInterface $slugger, MailerInterface $mailer): Response
    {
        $absence = new AbsEtudiant;

        $form = $this->createForm(AbsenceEtType::class, $absence);
        $form->handleRequest($req);
        $user = $this->getUser('email');

        if ($form->isSubmitted() && $form->isValid()) {
            $imgJustif = $form['imgJustif']->getData();
            if ($imgJustif) {
                $originalFileName = pathinfo($imgJustif->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFileName = $slugger->slug($originalFileName);
                $newFileName = $safeFileName . '-' . uniqid() . '.' . $imgJustif->guessExtension();

                $imgJustif->move(
                    $this->getParameter('imgjust_directory'),
                    $newFileName
                );

                $absence->setImgJust($newFileName);
            }


            $userEtudiant = $absence->setEtudiant($user);
            $createdAt = $absence->setCreatedAt(new \Datetime('now'));
            $em->persist($createdAt);
            $em->persist($userEtudiant);
            $em->persist($absence);
            $em->flush();

            ////Mailing/////////
            $parent = $form['email1']->getData();
            // $scolarite = $form['email2']->getData();
            $scolarite = 'respon@scolarite.com';
            $toAdresses = [$parent, new Address($scolarite)];
            $motifEmail = $form['motif']->getData();

            $email = (new TemplatedEmail())
                ->from('admin@rydan.com')
                ->to(...$toAdresses)
                ->subject('Absence')
                // ->text( ' est absent')
                ->htmlTemplate('email/model.html.twig')
                ->context([
                    'UserEmail' => $user,
                    'Motif' => $motifEmail
                ]);

            $mailer->send($email);

            $this->addFlash('success', 'Absence envoyer');
            return $this->redirectToRoute('absenceEtudiant');
        }

        return $this->render('etudiant/absence.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route('Etudiant/depAnt', name: 'dep_antEtudiant')]
    public function DepAntEtudiant(Request $req, EntityManagerInterface $em, MailerInterface $mailer): Response
    {
        $depAnt = new DepAntEtudiant;

        $form = $this->createForm(DepAntEtudiantType::class, $depAnt);
        $form->handleRequest($req);
        $user = $this->getUser('email');
        if ($form->isSubmitted() && $form->isValid()) {
            $userEtudiant = $depAnt->setEtudiant($user);
            $em->persist($userEtudiant);
            $em->persist($depAnt);
            $em->flush();

            ////Mailing/////////
            $parent = $form['email1']->getData();
            // $scolarite = $form['email2']->getData();
            $scolarite = 'respon@scolarite.com';
            $toAdresses = [$parent, new Address($scolarite)];
            $motifEmail = $form['motif']->getData();

            $email = (new TemplatedEmail())
                ->from('admin@rydan.com')
                ->to(...$toAdresses)
                ->subject('Absence')
                // ->text( ' est absent')
                ->htmlTemplate('email/model.html.twig')
                ->context([
                    'UserEmail' => $user,
                    'Motif' => $motifEmail
                ]);

            $mailer->send($email);

            $this->addFlash('success', 'Demande de départ anticipé envoyer');
            return $this->redirectToRoute('dep_antEtudiant');
        }

        return $this->render('etudiant/dep_ant.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('Etudiant/retard', name: 'retardEtudiant')]
    public function retardEtudiant(Request $req, EntityManagerInterface $em, MailerInterface $mailer): Response
    {
        $retard =  new RetardEtudiant;

        $form = $this->createForm(RetardEtudiantType::class, $retard);
        $form->handleRequest($req);
        $user = $this->getUser('email');
        if ($form->isSubmitted() && $form->isValid()) {
            $userEtudiant = $retard->setEtudiant($user);
            $createdAt = $retard->setCreatedAt(new \DateTime('now'));
            $em->persist($createdAt);
            $em->persist($userEtudiant);
            $em->persist($retard);
            $em->flush();

            ////Mailing/////////
            $parent = $form['email1']->getData();
            // $scolarite = $form['email2']->getData();
            $scolarite = 'respon@scolarite.com';
            $toAdresses = [$parent, new Address($scolarite)];
            $motifEmail = $form['motif']->getData();

            $email = (new TemplatedEmail())
                ->from('admin@rydan.com')
                ->to(...$toAdresses)
                ->subject('Absence')
                // ->text( ' est absent')
                ->htmlTemplate('email/model.html.twig')
                ->context([
                    'UserEmail' => $user,
                    'Motif' => $motifEmail
                ]);

            $mailer->send($email);

            $this->addFlash('success', 'Retard envoyer');
            return $this->redirectToRoute('retardEtudiant');
        }

        return $this->render('etudiant/retard.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
