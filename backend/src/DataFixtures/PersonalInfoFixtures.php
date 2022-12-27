<?php

namespace App\DataFixtures;

use App\Entity\PersonalInfo;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PersonalInfoFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $personalInfo = new PersonalInfo();
        $personalInfo->setWorkAs('Web Developer');
        $personalInfo->setWorkFor('EncodeIT');
        $personalInfo->setWorkFrom(new \DateTime());
        $personalInfo->setWorkTo(null);
        $personalInfo->setUniversity('The Silesian Technical University');
        $personalInfo->setSocials([
            'github' => 'BrittleHeart',
            'linkedin' => 'b-pazdur',
            'twitter' => 'ovvest',
            'facebook' => 'bartosz.pazdur.1',
            'goodreads' => '138188568-bartosz-pazdur',
        ]);
        $personalInfo->setSkills([
            'programming' => [
                'PHP',
                'JavaScript',
                'TypeScript',
                'Vue',
                'PostgreSQL',
                'MySQL',
                'Docker',
                'Git',
            ],
            'languages' => [
                'Polish (native)',
                'English (B2)',
                'Russian (A2)',
                'Norwegian (Bokmål)',
            ],
        ]);
        $personalInfo->setProjects([
            [
                'name' => 'EncodeIT',
                'description' => 'A website for EncodeIT company',
                'url' => 'https://encodeit.pl',
                'github' => 'some'
            ],
            [
                'name' => 'Blog',
                'description' => 'A blog for my personal projects',
                'url' => 'https://blog.ovvest.com',
                'github' => 'some'
            ],
            [
                'name' => 'Ovvest',
                'description' => 'A website for my personal projects',
                'url' => 'https://ovvest.com',
                'github' => 'some'
            ],
        ]);

        $personalInfo->setCreatedAt(new \DateTimeImmutable());
        $manager->persist($personalInfo);
        $manager->flush();
    }
}
