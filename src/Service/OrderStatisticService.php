<?php


namespace App\Service;


use App\Entity\RangeDateSale;
use App\Repository\OrderRepository;
use Carbon\Carbon;

class OrderStatisticService
{
    private const DAY_IN_SECOND = 86400;
    private $orderRepository;
    /**
     * OrderStatisticService constructor.
     */
    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function getStatisticSales(string $dateStart = null, string $dateEnd = null):array{
        $orderRepository = $this->orderRepository;
        $orders = $orderRepository->findRangeDate($dateStart, $dateEnd);
        $statisticSales = [];
        foreach ($orders as $order){
            $product = $order->getProductId();
            $rangeDateSale = $order->getRangeDateSalesId();
            $productId = $product->getId();
            $statisticSales[$productId] = $statisticSales[$productId] ?? [
                'name' => $product->getName(),
                'all_sales' => 0,
                'days' => [],
                'sales_in_day' => 0,
                ];
            $statisticSales[$productId]['all_sales'] += $order->getSaleCount();
            $statisticSales[$productId]['days'][$rangeDateSale->getId()] = $statisticSales[$productId]['days'][$rangeDateSale->getId()] ??
                $this->getSecondsInSale($rangeDateSale, $dateStart, $dateEnd);
        }

        return array_map(function ($item){
            $item['days'] = array_sum($item['days']) / self::DAY_IN_SECOND;
            $item['sales_in_day'] = $item['all_sales'] / $item['days'];
            return $item;
        }, $statisticSales);
    }

    private function getSecondsInSale(RangeDateSale $rangeDateSale, string $dateStart = null, string $dateEnd = null):int{
        if(!$dateStart && !$dateEnd){
            $dateStop = $rangeDateSale->getDateStop();
            return Carbon::create($dateStop)->diffInSeconds($rangeDateSale->getDateStart());
        }

        $dateStartFilter = Carbon::createFromFormat('Y-m-d H:i:s', $dateStart .' 00:00:00');
        $dateEndFilter = Carbon::createFromFormat('Y-m-d H:i:s', $dateEnd .' 00:00:00');

        $rangeDateStart = new Carbon($rangeDateSale->getDateStart());
        $rangeDateStop = new Carbon($rangeDateSale->getDateStop());

        $dateStartActual = $dateStartFilter->getTimestamp() > $rangeDateStart->getTimestamp() ? $dateStartFilter :  $rangeDateStart;
        $dateEndActual = $dateEndFilter->getTimestamp() < $rangeDateStop->getTimestamp() ? $rangeDateStop :  $rangeDateStop;

        return $dateEndActual->diffInSeconds($dateStartActual);
    }
}