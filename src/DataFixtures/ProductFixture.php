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

            $dateStart = Carbon::createFromTimestamp(1609480800, 'Asia/Bishkek');

            foreach (range(0, 9) as $j){
                $range = new RangeDateSale();
                $range->setProductId($product);
                $range->setDateStart($dateStart);
                $dateStop = Carbon::create($dateStart)->addSecond(rand(3600, 864000));
                $range->setDateStop($dateStop);
                $manager->persist($range);
                $cost = rand(1, 1000);

                foreach (range(0, rand(1, 100)) as $k){
                    $order = new Order();
                    $count = rand(1, 1000);
                    $order->setProductId($product);
                    $order->setRangeDateSalesId($range);
                    $order->setSaleCount($count);
                    $order->setSaleSum($cost * $count);
                    $order->setSaleDate(Carbon::createFromTimestamp(rand($dateStart->unix(), $dateStop->unix())), 'Asia/Bishkek');
                    $manager->persist($order);
                }

                $dateStart = Carbon::create($dateStop)->addDay(rand(1, 10));
            }
        }

        $manager->flush();
    }
}
