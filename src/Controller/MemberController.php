<?php

namespace App\Controller;
 
use App\Entity\User;
use App\Entity\Thread;
 
use App\Entity\Upload;
use App\Entity\Message;
use App\Form\MemberType;
use App\Form\UploadType;
use App\Form\MessageType;
use App\Entity\Departement;
use App\Form\ThreadFormType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
 

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

            if($user->getZipCode() != null){

                $userDep = $this->getDoctrine()
                  ->getRepository(Departement::class)
                  ->findByZipCode($user->getZipCode());

                $user->setDepartement($userDep);
            }
            else{
                $user->setDepartement(null);
            }


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

    /**
     * @Route("/photo", name="member_photo")
     */
    public function showUpload(Request $request){

        $upload = new Upload();
        $form = $this->createForm(UploadType::class, $upload);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $file = $upload->getName();
            $fileName = $this->getUser()->getId().'.'.$file->guessExtension();
            $file->move($this->getParameter('upload_directory'), $fileName);
            
            $this->getUser()->setPhotoSrc($fileName);
            $this->getUser()->setPhotoAlt('photo de '.$this->getUser()->getEmail());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($upload);
            $entityManager->flush();
        }

        return $this->render('member/photo.html.twig', ['mainNavMember'=>true, 
                                                        'title'=>'Votre photo',
                                                        'form' => $form->createView()
                                                        ]);
    }

    /**
     * @Route("/threads", name="member_threads")
     */
    public function showThreads(Request $request){



        return $this->render('member/threads.html.twig', ['mainNavMember'=>true, 
                                                        'title'=>'Vos fils de discussion'
                                                        ]);
    }

    /**
     * @Route("/thread/{id}", name="thread")
     */
    public function showThread(Request $request, $id){

        $thread = $this->getDoctrine()
                     ->getRepository(Thread::class)
                     ->find($id);

        $message = new Message();
        $form = $this->createForm(MessageType::class, $message);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){


            $message->setUserSender($this->getUser());
            if($this->getUser() == $thread->getUserCreator()){
                $message->setUserRecipient($thread->getUserRecipient());
            }
            else{
                $message->setUserRecipient($thread->getUserCreator());
            }
            $message->setThread($thread);
            $message->setTimestamp(new \DateTime());
            $message->setIsRead(false);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($message);
            $entityManager->flush(); 
        }

        return $this->render('member/thread.html.twig', ['mainNavMember'=>true, 
                                                        'title'=> $thread->getTitle(),
                                                        'thread' => $thread,
                                                        'form' => $form->createView()
                                                        ]);
    }

    /**
     * @Route("/threadeditor/{recipientId}", name="thread_editor")
     */
    public function startThread($recipientId, Request $request){

        $user = $this->getDoctrine()
                     ->getRepository(User::class)
                     ->find($recipientId);

        $thread = new Thread();
        $message = new Message();
        $form = $this->createForm(ThreadFormType::class, $thread);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
 
            $data = $form['text']->getData();

            $thread->setUserCreator($this->getUser());
            $thread->setUserRecipient($user);

            $message->setUserSender($this->getUser());
            $message->setUserRecipient($user);
            $message->setThread($thread);
            $message->setTimestamp(new \DateTime());
            $message->setText($data);
            $message->setIsRead(false);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($thread);
            $entityManager->persist($message);
            $entityManager->flush();

            $this->addFlash('success', 'Le nouveau fil de discussion a été créé et votre message a été envoyé à '.$user->getEmail());
        }

        return $this->render('member/threadeditor.html.twig', ['mainNavMember'=>true, 
                                                               'title'=>'Commencer un fil de discussion avec '.$user->getEmail(),
                                                               'user' => $user,
                                                               'form' => $form->createView()
                                                              ]);
    }

    /**
     * @Route("/threaddelete/{id}", name="thread_delete")
     */
    public function deleteThread($id){

        $thread = $this->getDoctrine()
                     ->getRepository(Thread::class)
                     ->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($thread); 
        $entityManager->flush();

        return $this->redirectToRoute('member_threads');

    }
}
