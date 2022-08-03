<?php

namespace App\Controller;

use App\Entity\Commentaires;
use App\Form\CommentairesType;
use DateTime;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogueController extends AbstractController
{
    #[Route('/blogue', name: 'app_blog')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        $commentaire = new Commentaires;

        $form = $this->createForm(CommentairesType::class, $commentaire);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $commentaire->setCreatedAt(new DateTimeImmutable());

            $em->persist($commentaire);
            $em->flush();
        }

        return $this->render('blogue/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
