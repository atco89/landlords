<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class UserFixture extends Fixture implements OrderedFixtureInterface
{

    public function getOrder(): int
    {
        return 2;
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();

        $user->setName('Aleksandar');
        $user->setSurname('Rakić');
        $user->setEmail('aleksandar.rakic@yahoo.com');
        $user->setPassword('password');
        $user->setActivated(true);

        $manager->persist($user);
        $manager->flush();
    }
}
