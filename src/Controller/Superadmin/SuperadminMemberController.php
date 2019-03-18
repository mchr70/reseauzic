<?php

namespace App\Controller\Superadmin;

use App\Entity\User;
use App\Form\MemberType;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/** @Route("/superadmin") */
class SuperadminMemberController extends AbstractController
{
    /**
     * @Route("/members", name="superadmin_members")
     */
    public function showMembers(UserRepository $repo)
    {
        $users = $repo->findAll();

        return $this->render('superadmin/members.html.twig', [
            'controller_name' => 'AdminMemberController',
            'users' => $repo->findAll(),
            'title' => 'Gestion des membres'
            ]);
    }

    /**
     * @Route("/member/{id}", name="superadmin_member")
     */
    public function showMember(Request $request, $id)
    {
        $user = $this->getDoctrine()
                     ->getRepository(User::class)
                     ->find($id);
        // 1) build the form
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

        return $this->render('superadmin/member.html.twig', ['mainNavMember'=>true, 
                                                        'title'=>'Profil du membre ' . $user->getUsername(),
                                                        'user' => $user,
                                                        'form' => $form->createView()]);
    }

    /**
     * @Route("/togglemember/{id}", name="superadmin_member_toggle")
     */
    public function deleteMember($id)
    {
        $user = $this->getDoctrine()
                     ->getRepository(User::class)
                     ->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        
        if($user->getIsActive()){
            $user->setIsActive(false);
            $this->addFlash('warning', 'Cet utilisateur a reçu un ban et n\'est plus actif');
        }
        else{
            $user->setIsActive(true);
            $this->addFlash('success', 'Cet utilisateur est à nouveau actif');
        }

        $entityManager->flush();

        return $this->redirectToRoute('superadmin_members');
    }

    /**
     * @Route("/setadmin/{id}", name="superadmin_setadmin")
     */
    public function setAdmin($id, UserRepository $repo)
    {
        $user = $this->getDoctrine()
                     ->getRepository(User::class)
                     ->find($id);

        $entityManager = $this->getDoctrine()->getManager();
 
        $user->addRole('ROLE_ADMIN');
        // $user->addRole('ROLE_ADMIN');
        // $user->setRoles([]);
dump($user->getRoles());
        $entityManager->persist($user);
        $entityManager->flush();

        // return $this->redirectToRoute('superadmin_members');
        return $this->render('superadmin/members.html.twig', [
            'controller_name' => 'AdminMemberController',
            'users' => $repo->findAll(),
            'title' => 'Gestion des membres'
            ]);
    }

    /**
     * @Route("/setuser/{id}", name="superadmin_setuser")
     */
    public function setUser($id, UserRepository $repo)
    {
        $user = $this->getDoctrine()
                     ->getRepository(User::class)
                     ->find($id);

        $entityManager = $this->getDoctrine()->getManager();
  
        $user->setRoles([]);
dump($user->getRoles());
        $entityManager->persist($user);
        $entityManager->flush();

        // return $this->redirectToRoute('superadmin_members');
        return $this->render('superadmin/members.html.twig', [
            'controller_name' => 'AdminMemberController',
            'users' => $repo->findAll(),
            'title' => 'Gestion des membres'
            ]);
    }
}
