<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        // $year = array_rand(range(1,2024));
        // $month = array_rand(range(1,12));
        // $day = array_rand(range(1,28));
        // if($year>2010){
        //     $date = date($year.'-'.$month.'-'.$day);
        // dd($date);
        // }
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
