<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\PasswordUpdate;
use App\Form\PasswordUpdateType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;

class SecurityController extends Controller {

    /**
     * @Route("/login", name="login")
     */
    public function login(Request $request, AuthenticationUtils $authenticationUtils) {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        //
        $form = $this->get('form.factory')
                ->createNamedBuilder(null)
                ->add('_username', null, ['label' => 'Email'])
                ->add('_password', \Symfony\Component\Form\Extension\Core\Type\PasswordType::class, ['label' => 'Mot de passe'])
                ->add('ok', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class, ['label' => 'Ok', 'attr' => ['class' => 'btn-primary btn-block']])
                ->getForm();
        return $this->render('security/login.html.twig', [
                    'mainNavLogin' => true, 'title' => 'Connexion',
                    //
                    'form' => $form->createView(),
                    'last_username' => $lastUsername,
                    'error' => $error,
        ]);
    }

    /**
     * @Route("/forgotten_password", name="forgotten_password")
     */
    public function forgottenPassword(
        Request $request,
        UserPasswordEncoderInterface $encoder,
        \Swift_Mailer $mailer,
        TokenGeneratorInterface $tokenGenerator
    ): Response
    {

        if ($request->isMethod('POST')) {

            $email = $request->request->get('email');

            $entityManager = $this->getDoctrine()->getManager();
            $user = $entityManager->getRepository(User::class)->findOneByEmail($email);
            /* @var $user User */

            if ($user === null) {
                $this->addFlash('danger', 'Email Inconnu');
                return $this->redirectToRoute('forgotten_password');
            }
            $token = $tokenGenerator->generateToken();

            try{
                $user->setResetToken($token);
                $entityManager->flush();
            } catch (\Exception $e) {
                $this->addFlash('warning', $e->getMessage());
                return $this->redirectToRoute('forgotten_password');
            }

            $url = $this->generateUrl('reset_password', array('token' => $token), UrlGeneratorInterface::ABSOLUTE_URL);

            $message = (new \Swift_Message('Mot de passe oublié'))
                ->setFrom('mchr70@gmail.com')
                ->setTo($user->getEmail())
                ->setBody(
                    "Bonjour,\n Voici le lien qui vous permettra de définir un nouveau mot de passe sur réseauzic : " . $url,
                    'text/html'
                );

            $mailer->send($message);

            $this->addFlash('notice', 'Mail envoyé');

            return $this->redirectToRoute('forgotten_password');
        }

        return $this->render('security/forgotten_password.html.twig',[
            'title' => 'Mot de passe oublié'
        ]);
    }

    /**
     * @Route("/reset_password/{token}", name="reset_password")
     */
    public function resetPassword(Request $request, string $token, UserPasswordEncoderInterface $passwordEncoder)
    {

        // 1) build the form
        $passupdate = new PasswordUpdate();
        $form = $this->createForm(PasswordUpdateType::class, $passupdate);
        
        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();

            $user = $entityManager->getRepository(User::class)->findOneByResetToken($token);
            /* @var $user User */

            if ($user === null) {
                $this->addFlash('danger', 'Token Inconnu');
                return $this->redirectToRoute('reset_password');
            }

            $newPassword = $passupdate->getNewPassword();
            $hash = $passwordEncoder->encodePassword($user, $newPassword);
            $user->setPassword($hash);

            $user->setResetToken(null);

            $entityManager->persist($user);
            $entityManager->flush();

        }

        return $this->render('security/reset_password.html.twig', ['mainNavMember'=>true, 
                                                        'title'=>'Réinitialiser votre mot de passe',
                                                        'form' => $form->createView()]);

    }

}
