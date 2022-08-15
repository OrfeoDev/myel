<?php

namespace App\Controller\BackOffice;

use App\Entity\DemandeDeDevis;
use App\Entity\DemandeStatut;
use App\Entity\Mariee;
use App\Repository\DemandeDeDevisRepository;
use App\Repository\DemandeStatutRepository;
use App\Repository\MarieeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DashboardController extends AbstractController
{
    #[Route('/backofficedashboard', name: 'app_back_office_dashboard')]
    #[IsGranted('ROLE_ADMIN')]
    public function index(DemandeDeDevisRepository $demandeDeDevisRepository, MarieeRepository $marieeRepository,DemandeStatutRepository $demandeStatut): Response
    {
         /**
         * @var DemandeStatut
         */
        $todoStatut = $demandeStatut->findOneByValue("todo");

        /**
         * @var DemandeStatut
         */
        $doneStatut = $demandeStatut->findOneByValue("done");

        // 2 : Récupération de toutes les demandes pro et de devis non traitées
        $demandesProTodo = $todoStatut->getMariee();
      

        // 3 : Récupération de toutes les demandes pro et devis traitées
        $demandesProDone = $doneStatut->getMariee();
//       $mariees = $marieeRepository->findAll();
// //dd($mariees);

        /**
         * @var DemandeDeDevis
         */

//$demande = $marieeRepository->findBy([],['dateMariage'=> 'DESC']);

// dd($demande);


        return $this->render('backoffice/dashboard/index.html.twig', [
            'demandes'=> $marieeRepository->findAll(),
            'doneStatut'=>$doneStatut,
            'demandesProTodo'=> $demandesProTodo,
            'demandesProDone' => $demandesProDone,
           'demande' =>$marieeRepository

        ]);
    }
    #[Route('/backofficedashboard/change-status-of-demande/{id}', name: 'app_back_office_dashboard-status')]
    #[IsGranted('ROLE_ADMIN')]
    public function changeStatus(EntityManagerInterface $em,DemandeDeDevisRepository $demandeDeDevisRepository, Mariee $mariee,DemandeStatutRepository $demandeStatut): Response
    {
      /**
       * 
       *@var DemandeStatut
       */
      $todoStatut = $demandeStatut->findOneByValue("todo");
      $todoStatut->removeMariee($mariee);
      /**
       * @var DemandeStatut
       */
      $doneStatut = $demandeStatut->findOneByValue("done");
      $doneStatut->addMariee($mariee);

      $em->persist($doneStatut);
      $em->persist($todoStatut);
      $em->persist($mariee);

      $em->flush();

      $this->addFlash(
          'success',
          'La demande a été traitée avec succès'
      );

       return $this->redirectToRoute('app_back_office_dashboard');
    }

    #[Route('/backofficedashboard/suprimer/{id}', name: 'app_back_office_dashboard-supprimer')]
    #[IsGranted('ROLE_ADMIN')]
    public function supprimer (EntityManagerInterface $em, Mariee $mariee,DemandeStatutRepository $demandeStatut): Response
    {
      /**
       * 
       *@var Mariee
       */
    
      $em->remove($mariee);
      $em->flush();

      $this->addFlash(
          'success',
          'La demande a été traitée avec succès'
      );

       return $this->redirectToRoute('app_back_office_dashboard');
    }


}
