<?php

namespace App\Controller;

use App\Entity\AbsProf;
use App\Entity\DepAntProf;
use App\Entity\RetardProf;
use App\Form\AbsenceProfType;
use App\Form\DepAntProfType;
use App\Form\RetardProfType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Annotation\Route;

class ProfController extends AbstractController
{
    #[Route('Prof/absence', name: 'absenceProf')]
    public function absenceProf(Request $req, EntityManagerInterface $em, MailerInterface $mailer): Response
    {
        $absence = new AbsProf;

        $form = $this->createForm(AbsenceProfType::class, $absence);
        $form->handleRequest($req);
        $user = $this->getUser('email');
        if ($form->isSubmitted() && $form->isValid()) {
            $userProf = $absence->setProf($user);
            $createdAt = $absence->setCreatedAt(new \Datetime('now'));
            $em->persist($createdAt);
            $em->persist($userProf);
            $em->persist($absence);
            $em->flush();

            ////Mailing/////////
            $parent = $form['email1']->getData();
            // $scolarite = $form['email2']->getData();
            $scolarite = 'respon@scolarite.com';
            $toAdresses = [$parent, new Address($scolarite)];
            $motifEmail = $form['motif']->getData();
            $title = 'Absence';
            $email = (new TemplatedEmail())
                ->from('admin@rydan.com')
                ->to(...$toAdresses)
                ->subject($title)
                // ->text( ' est absent')
                ->htmlTemplate('email/model.html.twig')
                ->context([
                    'Title' => $title,
                    'UserEmail' => $user,
                    'Motif' => $motifEmail
                ]);

            $mailer->send($email);

            $this->addFlash('success', 'Absence envoyer');
            return $this->redirectToRoute('absenceProf');
        }

        return $this->render('prof/absence.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('Prof/depAnt', name: 'dep_antProf')]
    public function DepAntProf(Request $req, EntityManagerInterface $em, MailerInterface $mailer): Response
    {
        $depAnt = new DepAntProf;

        $form = $this->createForm(DepAntProfType::class, $depAnt);
        $form->handleRequest($req);
        $user = $this->getUser('email');
        if ($form->isSubmitted() && $form->isValid()) {
            $userEtudiant = $depAnt->setProf($user);
            $createdAt = $depAnt->setCreatedAt(new \datetime('now'));
            $em->persist($createdAt);
            $em->persist($userEtudiant);
            $em->persist($depAnt);
            $em->flush();

            ////Mailing/////////
            $parent = $form['email1']->getData();
            // $scolarite = $form['email2']->getData();
            $scolarite = 'respon@scolarite.com';
            $toAdresses = [$parent, new Address($scolarite)];
            $motifEmail = $form['motif']->getData();
            $title = 'Depart anticipé';
            $email = (new TemplatedEmail())
                ->from('admin@rydan.com')
                ->to(...$toAdresses)
                ->subject($title)
                // ->text( ' est absent')
                ->htmlTemplate('email/model.html.twig')
                ->context([
                    'Title' => $title,
                    'UserEmail' => $user,
                    'Motif' => $motifEmail
                ]);

            $mailer->send($email);

            $this->addFlash('success', 'Demande de départ anticipé envoyer');
            return $this->redirectToRoute('dep_antProf');
        }

        return $this->render('prof/dep_ant.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('Prof/retard', name: 'retardProf')]
    public function retardProf(Request $req, EntityManagerInterface $em, MailerInterface $mailer): Response
    {
        $retard =  new RetardProf;

        $form = $this->createForm(RetardProfType::class, $retard);
        $form->handleRequest($req);
        $user = $this->getUser('email');
        if ($form->isSubmitted() && $form->isValid()) {
            $userEtudiant = $retard->setProf($user);
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
            $title = 'Retard';
            $email = (new TemplatedEmail())
                ->from('admin@rydan.com')
                ->to(...$toAdresses)
                ->subject($title)
                // ->text( ' est absent')
                ->htmlTemplate('email/model.html.twig')
                ->context([
                    'Title' => $title,
                    'UserEmail' => $user,
                    'Motif' => $motifEmail
                ]);

            $mailer->send($email);

            $this->addFlash('success', 'Retard envoyer');

            return $this->redirectToRoute('retardProf');
        }

        return $this->render('prof/retard.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
