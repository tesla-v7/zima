<?php

namespace App\Controller;

use App\Service\OrderStatisticService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainTestController extends AbstractController
{
    /**
     * @Route("/main/sales", name="main_sales")
     */
    public function index(Request $request, OrderStatisticService $orderStatisticService): Response
    {
        $dateStart = $request->get('date_start', null);
        $dateEnd = $request->get('date_end', null);
        $actionPath = $this->generateUrl('main_sales');
        $statisticSales = $orderStatisticService->getStatisticSales($dateStart, $dateEnd);

        return $this->render('main_test/index.html.twig', [
            'controller_name' => 'MainTestController',
            'dateStart' => $dateStart,
            'dateEnd' => $dateEnd,
            'statistic' => $statisticSales,
            'actionPath' => $actionPath,
        ]);
    }
}
