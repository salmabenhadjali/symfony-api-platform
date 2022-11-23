<?php

namespace App\DataFixtures;

use App\Entity\BlogPost;
use App\Entity\Comment;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class AppFixtures extends Fixture
{

    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * @var \Faker\Factory
     */
    private $faker;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->faker = \Faker\Factory::create();
    }

    public function load(ObjectManager $manager): void
    {
        $this->loadUsers($manager);
        $this->loadBlogPosts($manager);
        $this->loadComments($manager);


    }

    public function loadBlogPosts(ObjectManager $manager)
    {
        $user = $this->getReference('admin');
        for ($i = 0; $i < 100; $i++) {
            $blogPost = new BlogPost();
            $blogPost->setTitle($this->faker->realText(12));
            $blogPost->setPublished($this->faker->dateTimeThisYear);
            $blogPost->setContent($this->faker->realText(30));
            $blogPost->setSlug($this->faker->slug);
            $blogPost->setAuthor($user);

            $this->setReference('blog_post_'.$i, $blogPost);

            $manager->persist($blogPost);
        }
        $manager->flush();
    }

    public function loadComments(ObjectManager $manager)
    {
        $user = $this->getReference('admin');

        for ($i = 0; $i < 100 ; $i++) {
            for ($j = 0; $j < rand(1, 10) ; $j++) {
                $comment = new Comment();
                $comment->setAuthor($user);
                $comment->setContent($this->faker->realText(20));
                $comment->setPublished($this->faker->dateTimeThisYear);
                $blogPost = $this->getReference('blog_post_'.$i);
                $comment->setBlogPost($blogPost);

                $manager->persist($comment);
            }
        }

        $manager->flush();
    }

    public function loadUsers(ObjectManager $manager)
    {
        $user = new User();
        $user->setName('salma');
        $user->setEmail('salma@bha.com');
        $user->setUsername('salma.bha');
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'secretPassword1234'
        ));

        $this->addReference('admin', $user);

        $manager->persist($user);
        $manager->flush();
    }
}
