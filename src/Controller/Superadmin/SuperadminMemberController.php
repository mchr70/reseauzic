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
     * @Route("/deletemember/{id}", name="superadmin_member_delete")
     */
    public function deleteMember($id)
    {
        $user = $this->getDoctrine()
                     ->getRepository(User::class)
                     ->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($user);
        $entityManager->flush();

        return $this->redirectToRoute('admin_members');
    }
}
