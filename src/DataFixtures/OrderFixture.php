<?php

namespace App\DataFixtures;

use App\Entity\Order;
use App\Entity\RangeDateSale;
use Carbon\Carbon;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class OrderFixture extends Fixture implements DependentFixtureInterface
{
    public function getDependencies()
    {
        // TODO: Implement getDependencies() method.
        return [
            RangeDateScaleFixture::class,
        ];
    }

    public function load(ObjectManager $manager)
    {
        $rangeDateSales = $manager->getRepository(RangeDateSale::class)
            ->findAll();

        foreach ($rangeDateSales as $rangeDateSale){
            $cost = rand(1, 1000);

            foreach (range(0, rand(1, 100)) as $k){
                $order = new Order();
                $count = rand(1, 1000);
                $dateSale = Carbon::createFromTimestamp(rand($rangeDateSale->getDateStartInTimestamp(), $rangeDateSale->getDateStopInTimestamp()));
                $order->setProductId($rangeDateSale->getProductId());
                $order->setRangeDateSalesId($rangeDateSale);
                $order->setSaleCount($count);
                $order->setSaleSum($cost * $count);
                $order->setSaleDate($dateSale, 'Asia/Bishkek');
                $manager->persist($order);
            }
        }

        $manager->flush();
    }
}
