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

    private const USERS = [
        [
            'name' => 'salma',
            'email' => 'alma@bha.com',
            'username' => 'salma.bha',
            'password' => 'secretPassword1234',
        ],
        [
            'name' => 'salma1',
            'email' => 'salma1@bha.com',
            'username' => 'salma1.bha',
            'password' => 'secretPassword12341',
        ],
        [
            'name' => 'salma2',
            'email' => 'salma2@bha.com',
            'username' => 'salma2.bha',
            'password' => 'secretPassword12342',
        ],
        [
            'name' => 'salma3',
            'email' => 'salma3@bha.com',
            'username' => 'salma3.bha',
            'password' => 'secretPassword12343',
        ],
    ];

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
        for ($i = 0; $i < 100; $i++) {
            $user = $this->getRandonUserReference();

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
        for ($i = 0; $i < 100 ; $i++) {
            for ($j = 0; $j < rand(1, 10) ; $j++) {
                $user = $this->getRandonUserReference();

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
        foreach (self::USERS as $userFixture) {
            $user = new User();
            $user->setName($userFixture['name']);
            $user->setEmail($userFixture['email']);
            $user->setUsername($userFixture['username']);
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                $userFixture['password']
            ));

            $this->addReference('user_'.$userFixture['username'], $user);

            $manager->persist($user);
        }
        $manager->flush();
    }

    /**
     * @return User
     */
    public function getRandonUserReference(): User
    {
        return $this->getReference('user_' . self::USERS[rand(0, 3)]['username']);
    }
}
