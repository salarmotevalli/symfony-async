<?php

namespace App\DataFixtures;

use App\Entity\Order;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // create 20 products! Bam!
        for ($i = 0; $i < 20; $i++) {
            $order = new Order();
            $order->setCode('order' . $i);
            $order->setPrice(mt_rand(10, 100));
            $order->setBuyer('buyer ' . $i);

            $manager->persist($order);
        }

        $manager->flush();
    }
}
