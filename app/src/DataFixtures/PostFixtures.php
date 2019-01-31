<?php

namespace App\DataFixtures;

use App\Entity\Post;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

final class PostFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @param ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        $user = $this->getReference('foo_user');
        $postEntity = new Post('Hello world. This is a great article about GraphQLite', $user);
        $manager->persist($postEntity);
        $this->addReference('postHelloWorld', $postEntity);

        $postEntity = new Post('GraphQLite is sooooo cool!', $user);
        $manager->persist($postEntity);
        $manager->flush();

    }

    public function getDependencies()
    {
        return array(
            UserFixtures::class,
        );
    }
}
