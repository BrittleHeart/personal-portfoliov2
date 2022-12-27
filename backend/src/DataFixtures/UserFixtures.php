<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('pl_PL');

        $user = new User();
        $hashedPassword = $this->passwordHasher->hashPassword($user, 'test');
        $user->setName('admin');
        $user->setEmail('admin@admin.com');
        $user->setPassword($hashedPassword);
        $user->setRoles(['ROLE_USER', 'ROLE_ADMIN']);
        $user->setLastActive(new \DateTime('now'));
        $user->setBanned(false);
        $user->setBannedFor( null);
        $user->setCreatedAt(new \DateTimeImmutable());

        $manager->persist($user);


        $manager->flush();
    }
}
