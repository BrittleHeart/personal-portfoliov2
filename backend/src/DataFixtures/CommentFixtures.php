<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use App\Enum\PostCommentStatusEnum;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CommentFixtures extends Fixture implements DependentFixtureInterface
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('pl_PL');
        $selectStatusFrom = [
            PostCommentStatusEnum::submitted()->value,
            PostCommentStatusEnum::approved()->value,
            PostCommentStatusEnum::rejected()->value,
        ];

        $commentsCaptions = [
            'Super post, dzięki za podzielenie się!',
            'Bardzo ciekawy artykuł, dzięki!',
            'Zbyt skomplikowane dla mnie',
            'ok',
            'Nie wiem co powiedzieć',
            'Nie podoba mi się',
            'chujowe, dziękuje serdecznie',
            'Ale, że jak?',
            "Mam małe pytanko",
            'Dzięki za ten artykuł',
            'Więcej takich artykułów!',
        ];

        for ($i = 0; $i < 10; $i++) {
            $comment = new Comment();
            
            $user = $this->userRepository->findOneBy(['name' => 'admin']);

            $comment->setCaption($faker->randomElement($commentsCaptions));
            $comment->setStatus($faker->randomElement($selectStatusFrom));
            $comment->setContent($faker->text());
            $comment->setUserId($user);
            $comment->setLikes($faker->numberBetween(0, 10));
            $comment->setShared($faker->numberBetween(0, 10));
            $comment->setAddedAgo(new \DateInterval('PT' . $faker->numberBetween(1, 100) . 'M'));
            $comment->setCreatedAt(new \DateTimeImmutable());
            $manager->persist($comment);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
        ];
    }
}
