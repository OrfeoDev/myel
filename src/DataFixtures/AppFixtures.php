<?php

namespace App\DataFixtures;

use App\Entity\DemandeStatut;
use App\Entity\Mariee;
use App\Entity\User;
use DateTime;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        $admin = new User();
        $admin->setEmail("admin@gmail.com")
            ->setFullName("admin")
            ->setPassword($this->hasher->hashPassword($admin, "password"))
            ->setRoles(['ROLE_ADMIN']);

        $manager->persist($admin);



        for ($i = 0; $i < 3; $i++) {
            $user = new User();
            $user->setEmail("user@gmail.com".$i)
                ->setFullName("user" . $i)
                ->setPassword($this->hasher->hashPassword($user, "password"));
            $manager->persist($user);
        }



        for ($i = 0; $i < 5; $i++) {
            $mariee = new Mariee();
            $mariee->setNom('marrie' . $i)
                ->setPrenom('prenom' . $i)
                ->setMail("marie@gmail.com" . $i)
                ->setAdresse('adresse' . $i)
                ->setTelephone('04689756666' . $i)
                ->setDateMariage(new \DateTimeImmutable());
            $manager->persist($mariee);
        }
$statusDemandes = [
    [
        "libelle" => "Non traité",
        "value"   => "todo"
    ],
    [
        "libelle" => "Traité",
        "value"   => "done"
    ]

   
];
foreach($statusDemandes as $arrayStatut){
    $demandeStatut = new DemandeStatut;
    $demandeStatut->setLibelle($arrayStatut["libelle"])
                  ->setValue($arrayStatut["value"]);
                  
        $manager->persist($demandeStatut);
}
        $manager->flush();
    }
}
