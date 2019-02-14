<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;

class HomepageController extends Controller {

    /**
     * @Route("/")
     */
    public function index() {
        $recentUsers = $this->getDoctrine()
        ->getRepository(User::class)
        ->findAll();

        return $this->render('homepage/index.html.twig', ['mainNavHome'=>true, 
                                                          'title'=>'Accueil',
                                                          'recentUsers' => $recentUsers
        ]);
    }

}
