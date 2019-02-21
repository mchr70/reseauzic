<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\UserSearch;
use App\Form\UserSearchType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomepageController extends Controller {

    /**
     * @Route("/")
     */
    public function index(ObjectManager $manager, Request $request) {

        $users = $manager->createQuery('SELECT u 
                                        FROM App\Entity\User u 
                                        ORDER BY u.registrationDate DESC'
                                        )
                                        ->setMaxResults(3)
                                        ->getResult();

        $search = new UserSearch();
        $form = $this->createForm(UserSearchType::class, $search);
        $form->handleRequest($request);

        $selUsers =  $manager->createQuery('SELECT u 
                                            FROM App\Entity\User u 
                                            WHERE u.zipCode = :zipCode
                                            OR u.city = :city'
                                          )
                                    ->setParameter('zipCode', $search->getZipCode())
                                    ->setParameter('city', $search->getCity())
                                    ->getResult();

        dump($selUsers);

        return $this->render('homepage/index.html.twig', ['mainNavHome'=>true, 
                                                          'title'=>'Accueil',
                                                          'users' => $users,
                                                          'selUsers' => $selUsers,
                                                          'form' => $form->createView()
        ]);
    }

}
