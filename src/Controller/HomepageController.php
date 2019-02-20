<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomepageController extends Controller {

    /**
     * @Route("/")
     */
    public function index(ObjectManager $manager) {

        $users = $manager->createQuery('SELECT u 
                                        FROM App\Entity\User u 
                                        ORDER BY u.registrationDate DESC'
                                        )
                                        ->setMaxResults(3)
                                        ->getResult();

        return $this->render('homepage/index.html.twig', ['mainNavHome'=>true, 
                                                          'title'=>'Accueil',
                                                          'users' => $users
        ]);
    }

}
