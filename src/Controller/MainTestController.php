<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainTestController extends AbstractController
{
    /**
     * @Route("/main/sales", name="main_sales")
     */
    public function index(Request $request, ProductRepository $productRepository): Response
    {
        $dateStart = $request->get('date_start', null);
        $dateEnd = $request->get('date_end', null);
        $actionPath = $this->generateUrl('main_sales');
        $statisticSales = $productRepository->getStatisticSales($dateStart, $dateEnd);

        $statisticSales = array_map(function ($item){
            $item['days'] = array_sum(json_decode($item['dotted_day'], true));
            $item['sales_in_day'] = $item['all_sales'] / $item['days'];
            return $item;
        }, $statisticSales->fetchAll());

        return $this->render('main_test/index.html.twig', [
            'controller_name' => 'MainTestController',
            'statistic' => $statisticSales,
            'actionPath' => $actionPath,
        ]);
    }
}
