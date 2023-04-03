<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture implements OrderedFixtureInterface
{

    public function getOrder(): int
    {
        return 1;
    }

    public function load(ObjectManager $manager): void
    {
        $categories = ['Mac', 'iPad', 'iPhone', 'iWatch'];
        foreach ($categories as $category) {
            $manager->persist((new Category())->setName($category));
        }
        $manager->flush();
    }
}
