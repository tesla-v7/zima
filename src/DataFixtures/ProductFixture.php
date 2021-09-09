<?php

namespace App\DataFixtures;

use App\Entity\Order;
use App\Entity\Product;
use App\Entity\RangeDateSale;
use Carbon\Carbon;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        foreach (range(1, 10) as $i){
            $product = new Product();
            $product->setName('product_'.$i);
            $manager->persist($product);
        }

        $manager->flush();
    }
}
