<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        // $dates = mt_rand(strtotime('2010-06-01'),strtotime('2023-12-31'));
        // $date = date("Y-m-d", $dates);
        // $date1 = date("Y-m-d", $dates+35000000);
        // $d= new \DateTime($date);
        // dd([$d, $date, $date1]);
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
