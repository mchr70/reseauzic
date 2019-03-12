<?php

namespace App\Controller\Admin;

use App\Entity\Thread;
use App\Entity\Message;
use App\Repository\ThreadRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminThreadsController extends AbstractController
{
    /**
     * @Route("/admin/threads", name="admin_threads")
     */
    public function showThreads(ThreadRepository $repo)
    {
        return $this->render('admin/threads.html.twig', [
            'controller_name' => 'AdminThreadsController',
            'threads' => $repo->findAll()
        ]);
    }

    /**
     * @Route("/admin/thread/{id}", name="admin_thread")
     */
    public function showThread($id)
    {
        $thread = $this->getDoctrine()
                     ->getRepository(Thread::class)
                     ->find($id);

        return $this->render('admin/thread.html.twig', [
            'controller_name' => 'AdminThreadsController',
            'thread' => $thread
        ]);
    }

    /**
     * @Route("/adminthreaddelete/{id}", name="admin_thread_delete")
     */
    public function deleteThread($id){

        $thread = $this->getDoctrine()
                     ->getRepository(Thread::class)
                     ->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($thread); 
        $entityManager->flush();

        return $this->redirectToRoute('admin_threads');

    }

    /**
     * @Route("/adminmessagedelete/{id}", name="admin_message_delete")
     */
    public function deleteMessage($id){

        $message = $this->getDoctrine()
                     ->getRepository(Message::class)
                     ->find($id);

        $thread = $message->getThread();

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($message);
        dump(count($thread->getMessages()));
        if(count($thread->getMessages()) == 1){
            $entityManager->remove($thread);
        } 
        $entityManager->flush();

        return $this->redirectToRoute('admin_thread', ['id' => $id]);

    }
}
