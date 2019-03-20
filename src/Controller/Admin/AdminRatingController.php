<?php

namespace App\Controller\Admin;

use App\Entity\Rating;
use App\Repository\RatingRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminRatingController extends AbstractController
{
    /**
     * @Route("/admin/rating", name="admin_rating")
     */
    public function index(RatingRepository $repo)
    {

        return $this->render('admin/ratings.html.twig', [
            'title' => 'Gestion des évaluations',
            'controller_name' => 'AdminRatingController',
            'ratings' => $repo->findAll()
        ]);
    }

    /**
     * @Route("/admin/delete_rating{id}", name="admin_rating_delete")
     */
    public function deleteRating($id)
    {
        $rating = $this->getDoctrine()
                     ->getRepository(Rating::class)
                     ->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($rating); 
        $entityManager->flush();

        return $this->redirectToRoute('admin_rating');
    }
}
