<?php

namespace App\DataFixtures;

use App\Entity\Post;
use App\Enum\PostStatusEnum;
use App\Repository\CategoryRepository;
use App\Repository\CommentRepository;
use App\Repository\TagRepository;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PostFixture extends Fixture implements DependentFixtureInterface
{
    private UserRepository $userRepository;
    private CommentRepository $commentRepository;
    private CategoryRepository $categoryRepository;
    private TagRepository $tagRepository;

    public function __construct(
        UserRepository $userRepository,
        CommentRepository $commentRepository,
        CategoryRepository $categoryRepository,
        TagRepository $tagRepository
    ) {
        $this->userRepository = $userRepository;
        $this->commentRepository = $commentRepository;
        $this->categoryRepository = $categoryRepository;
        $this->tagRepository = $tagRepository;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('pl_PL');
        $selectStatusFrom = [
            PostStatusEnum::draft()->value,
            PostStatusEnum::published()->value,
            PostStatusEnum::archived()->value,
        ];
        
        $user = $this->userRepository->findOneBy(['name' => 'admin']);
        $categories = $this->categoryRepository->findAll();
        $comments = $this->commentRepository->findAll();
        $tags = $this->tagRepository->findAll();

        for ($i = 0; $i < 10; $i++) {
            $post = new Post();
            $post->setTitle($faker->sentence(3));
            $post->setDescription($faker->sentence(10));
            // set content with html
            $post->setContent($faker->randomHtml(2, 3));

            $comment = $faker->randomElement($comments);
            $category = $faker->randomElement($categories);
            $tag = $faker->randomElement($tags);

            $post->setUser($user);
            $post->setCategory($category);

            $post->setStatus($faker->randomElement($selectStatusFrom));

            // Do not add comment to draft / archived post
            if ($post->getStatus() === PostStatusEnum::published()->value) {
                $post->addComment($comment);
            }

            $post->addTag($tag);
            
            $post->setLikes($faker->numberBetween(0, 100));

            $post->setCreatedAt(new \DateTimeImmutable());

            $manager->persist($post);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            CategoryFixtures::class,
            CommentFixtures::class,
        ];
    }
}
