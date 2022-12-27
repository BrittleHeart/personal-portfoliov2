<?php

namespace App\DataFixtures;

use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TagFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $listOfTags = [
            'PHP',
            'JavaScript',
            'TypeScript',
            'algorithms',
            'data'
        ];

        foreach ($listOfTags as $tagName) {
            $tag = new Tag();
            $tag->setName($tagName);
            $tag->setCreatedAt(new \DateTimeImmutable());
            $manager->persist($tag);
        }

        $manager->flush();
    }
}
