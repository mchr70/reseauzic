<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
 
use App\Entity\User;
use App\Form\MemberType;

/** @Route("/member") */
class MemberController extends Controller {

    /**
     * @Route("/")
     */
    public function index(Request $request) {
        // 1) build the form
        $user = $this->getUser();
        $form = $this->createForm(MemberType::class, $user);
        
        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user
            $this->addFlash('success', 'Les modifications ont bien été enregistrées.');
            //return $this->redirectToRoute('login');
        }

        return $this->render('member/index.html.twig', ['mainNavMember'=>true, 
                                                        'title'=>'Espace Membre',
                                                        'form' => $form->createView()]);
    }

}
