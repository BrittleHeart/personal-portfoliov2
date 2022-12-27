<?php

namespace App\DataFixtures;

use App\Entity\Theme;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ThemeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('pl_PL');
        $editableParts = [
            'logo',
            'thumbnail',
            'background',
            'text',
            'button',
            'link',
        ];

        for ($i = 0; $i < 10; $i++) {
            $theme = new Theme();
            $theme->setName("Theme $i");
            $theme->setBackgroundUrl("https://picsum.photos/1920/1080");

            $setupLogoThumbnailUrl = $faker->boolean(40);

            $theme->setLogoUrl($setupLogoThumbnailUrl ? "https://picsum.photos/1920/1080" : null);
            $theme->setThumbnailUrl($setupLogoThumbnailUrl ? "https://picsum.photos/1920/1080" : null);
            $theme->setEditableParts($faker->randomElements($editableParts, 3));
            $theme->setPublished($faker->boolean(80));
            $theme->setCreatedAt(new \DateTimeImmutable());
            $manager->persist($theme);
        }

        $manager->flush();
    }
}
