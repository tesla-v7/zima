<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\RangeDateSale;
use Carbon\Carbon;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class RangeDateScaleFixture extends Fixture implements DependentFixtureInterface
{
    public function getDependencies()
    {
        // TODO: Implement getDependencies() method.
        return [
            ProductFixture::class,
        ];
    }

    public function load(ObjectManager $manager)
    {
        $products = $manager->getRepository(Product::class)
            ->findAll();


        foreach ($products as $product){
            $dateStart = Carbon::createFromTimestamp(1609480800, 'Asia/Bishkek');

            foreach (range(0, 9) as $j){
                $range = new RangeDateSale();
                $range->setProductId($product);
                $range->setDateStart($dateStart);
                $dateStop = Carbon::create($dateStart)->addSecond(rand(3600, 864000));
                $range->setDateStop($dateStop);
                $manager->persist($range);

                $dateStart = Carbon::create($dateStop)->addDay(rand(1, 10));
            }
        }
        $manager->flush();
    }
}
