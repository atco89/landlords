<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Repository\CategoryRepository;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture implements OrderedFixtureInterface
{

    public function __construct(
        private readonly UserRepository     $userRepository,
        private readonly CategoryRepository $categoryRepository,
    )
    {
    }

    public function getOrder(): int
    {
        return 3;
    }

    /**
     * @throws NonUniqueResultException
     */
    public function load(ObjectManager $manager): void
    {
        $product = new Product();

        $product->setTitle('Lorem ipsum dolor sit');
        $product->setDescription('Test test test');
        $product->setImage('https://istyle.hu/media/wysiwyg/HU/landing-pages/preselection/mbp-14-sg-2023.jpeg');
        $product->setPrice(123456.78);

        $product->setUser($this->userRepository->findOneByEmail('aleksandar.rakic@yahoo.com'));
        $product->setCategory($this->categoryRepository->findOneByName('Mac'));

        $manager->persist($product);
        $manager->flush();
    }
}
