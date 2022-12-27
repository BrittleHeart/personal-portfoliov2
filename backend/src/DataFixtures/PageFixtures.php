<?php

namespace App\DataFixtures;

use App\Entity\Page;
use App\Repository\ThemeRepository;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PageFixtures extends Fixture implements DependentFixtureInterface
{
    private ThemeRepository $themeRepository;
    private UserRepository $userRepository;

    public function __construct(
        ThemeRepository $themeRepository,
        UserRepository $userRepository
    ) {
        $this->themeRepository = $themeRepository;
        $this->userRepository = $userRepository;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('pl_PL');

        $themes = $this->themeRepository->findAll();
        $user = $this->userRepository->findOneBy(['name' => 'admin']);

        for ($i = 0; $i < 10; $i++) {
            $page = new Page();

            $page->addTheme($faker->randomElement($themes));
            $page->setUser($user);

            $addDescriptionProbability = $faker->boolean(70);

            $page->setName("Page $i");
            $page->setSlug("page-$i");
            $page->setEditable($faker->boolean(80));
            $page->setDescription($addDescriptionProbability ? $faker->sentence(5) : null);
            $page->setUrl("/page-$i");
            $page->setPublished($faker->boolean(80));
            $page->setCreatedAt(new \DateTimeImmutable());

            $manager->persist($page);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ThemeFixtures::class,
            UserFixtures::class,
        ];
    }
}
