<?php

namespace App\Controller\Admin;

use App\Repository\UserRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/** @Route("/admin") */
class AdminMemberController extends AbstractController
{
    /**
     * @Route("/members", name="admin_members")
     */
    public function showMembers(UserRepository $repo)
    {
        return $this->render('admin/members.html.twig', [
            'controller_name' => 'AdminMemberController',
            'users' => $repo->findAll()
            ]);
    }
}
