<?php

namespace App\Tests\Repository;

use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserRepositoryTest extends KernelTestCase
{
    private EntityManager $entityManager;

    protected function setUp(): void
    {
        $kernel = parent::bootKernel();
        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    /**
     * @testWith ["milena.wieczorek@pawlak.pl"]
     *          ["piotr.wojciechowski@adamczyk.org"]
     *        [""]
     */
    public function testDeleteInactiveUser(string $value): void
    {
        $userToDelete = $this->entityManager
            ->getRepository(User::class)
            ->findOneBY(['email' => $value]);
        
        $assertionUser = $this->entityManager
            ->getRepository(User::class)
            ->deleteInActiveUser($userToDelete);
        
        $this->assertNull($assertionUser);
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        // Memory leaks protection
        /** @see https://symfony.com/doc/current/testing/database.html */
        $this->entityManager->close();
    }
}
