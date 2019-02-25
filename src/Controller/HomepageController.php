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


        return $this->render('homepage/index.html.twig', ['mainNavHome'=>true, 
                                                          'title'=>'Accueil',
                                                          'users' => $users
        ]);
    }

    /**
     * @Route("/search", name="member_search")
     */
    public function searchMember(ObjectManager $manager, Request $request){

        $search = new UserSearch();
        $form = $this->createForm(UserSearchType::class, $search);
        $form->handleRequest($request);
        // if ($form->isSubmitted() && $form->isValid()) {
        //     $selUsers = $manager->getRepository(User::class)->findSearchedUsers($search->getZipCode(), $search->getInstruments());
        //     dump($selUsers[0]->getInstruments()[1]);
        // }
        $selUsers = "";
        if ($form->isSubmitted() && $form->isValid()) {
            $selUsers = $manager->createQuery('SELECT u FROM App\Entity\User u
                                               WHERE u.zipCode = :zipCode')
                                ->setParameter('zipCode', $search->getZipCode())
                                ->getResult();
            dump($selUsers);
        }
        
        return $this->render('homepage/search.html.twig', ['mainNavHome'=>true, 
                                                          'title'=>'Rechercher des membres',
                                                          'selUsers' => $selUsers,
                                                          'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/profile/{id}", name="member_profile")
     */
    public function showMemberProfile($id){

        $user = $this->getDoctrine()
                     ->getRepository(User::class)
                     ->find($id);

        return $this->render('homepage/profile.html.twig', [
            'title' => 'Profil de ' . $user->getEmail(),
            'user' => $user
        ]);
    }
}
