<?php

namespace App\Controller;

use App\Entity\Mariee;
use App\Form\DevisType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DemandeDevisController extends AbstractController
{
    #[Route('/demandedevis', name: 'app_demande_devis')]
    public function Devis(Request $request , EntityManagerInterface $em): Response
    {
        $mariee = new Mariee();

        $form = $this->createForm(DevisType::class,$mariee);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

           // $mariee = $form->getData();

//  $email = (new Email())
//            ->from('hello@example.com')
//            ->to('admin@gmail.com')
//            //->cc('cc@example.com')
//            //->bcc('bcc@example.com')
//            //->replyTo('fabien@example.com')
//            //->priority(Email::PRIORITY_HIGH)
//            ->subject('Time for Symfony Mailer!')
//            ->text('Sending emails is fun again!')
//            ->html('<p>See Twig integration for better HTML integration!</p>');

//        $mailer->send($email);
// // dd($mailer);



            $em->persist($mariee);
            $em->flush();
           

            $this->addFlash(
                'dark',
                'Votre demande de mariage a bien été envoyée, nous vous contacterons tres rapidement'
            );

            return $this->redirectToRoute('app_acceuil');
        }
   

        return $this->render('demande_devis/index.html.twig', [
            'form' => $form ->createView()
        ]);
    }
}
