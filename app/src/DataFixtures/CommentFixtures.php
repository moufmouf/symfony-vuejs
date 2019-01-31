<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use App\Entity\Post;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

final class CommentFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @param ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        $post = $this->getReference('postHelloWorld');
        $user = $this->getReference('foo_user');

        $commentEntity = new Comment('Lorem Ipsum', $post, $user);
        $manager->persist($commentEntity);

        $commentEntity = new Comment('TDBM forever!', $post, $user);
        $manager->persist($commentEntity);

        $commentEntity = new Comment('Mouf powaaa!', $post, $user);
        $manager->persist($commentEntity);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            UserFixtures::class,
            PostFixtures::class,
        );
    }
}
