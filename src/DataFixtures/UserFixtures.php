<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $hasher,
    ) {
    }
    public function load(ObjectManager $manager): void
    {
        $user = new User();

        $user->setLastName('Brunet')
            ->setFirstName('Thibaut')
            ->setEmail('admin@test.com')
            ->setRoles(['ROLE_ADMIN'])
            ->setPassword($this->hasher->hashPassword($user, 'Test1234'));

        $user2 = new User();
        $user2
            ->setLastName('CFP')
            ->setFirstName('CHARMILLES')
            ->setEmail('cfp@test.com')
            ->setRoles(['ROLE_ADMIN'])
            ->setPassword($this->hasher->hashPassword($user, 'cfpcharmilles'));

        $manager->persist($user);
        $manager->persist($user2);

        $manager->flush();
    }
}
