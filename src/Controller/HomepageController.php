<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Rating;
use App\Entity\Thread;
use App\Form\RatingType;
use App\Entity\Instrument;
use App\Entity\UserSearch;
use App\Form\ThreadFormType;
use App\Form\UserSearchType;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomepageController extends Controller {

    /**
     * @Route("/", name="home")
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

        $selUsers = "";
        $instIds = array();
        $genresIds = array();

        if ($form->isSubmitted() && $form->isValid()) {

            foreach($search->getInstruments() as $instrument){
                $instIds[] = $instrument->getId();
            }
            foreach($search->getGenres() as $genre){
                $genresIds[] = $genre->getId();
            }
             
            $em = $this->getDoctrine()->getManager();

            if(!empty($form["zipCode"]->getData()) OR !empty($instIds) OR !empty($genresIds)){
               $selUsers = $em->getRepository(User::class)
                                ->findByMultiple(
                                    $instIds, 
                                    $genresIds, 
                                    $form["zipCode"]->getData()
                                ); 
                
                if(empty($selUsers)){
                    $this->addFlash('warning', 'Aucun membre ne correspond à votre recherche');
                }
            }
            else{
                $this->addFlash('warning', 'Veuillez remplir au moins un critère de recherche!');
            }
                   
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
    public function showMemberProfile(Request $request, $id){

        $user = $this->getDoctrine()
                     ->getRepository(User::class)
                     ->find($id);

        $rating = new Rating();
        $form = $this->createForm(RatingType::class, $rating);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $entityManager = $this->getDoctrine()->getManager();

            $rating->setCreatedAt(new \DateTime());
            $rating->setUserSender($this->getUser());
            $rating->setUserRecipient($user);

            $entityManager->persist($rating);
            $entityManager->flush();
        }

        return $this->render('homepage/profile.html.twig', [
            'title' => 'Profil de ' . $user->getEmail(),
            'user' => $user,
            'form' => $form->createView()
        ]);
    }
}
