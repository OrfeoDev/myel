<?php

namespace App\DataFixtures;

use App\Entity\User;
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
        $admin->setEmail("admin@gmail;com")
        ->setFullName("admin")
        ->setPassword($this->hasher->hashPassword($admin,"password"))
        ->setRoles(['ROLE_ADMIN']);

        $manager->persist($admin);



        for ($u = 0; $u < 3; $u++)
        {
            $user = new User();
            $user->setEmail("user@gmail.com")
                ->setFullName("user".$u)
                ->setPassword($this->hasher->hashPassword($user,"password"));
        }
        
         $manager->persist($user);

        $manager->flush();
    }
}
