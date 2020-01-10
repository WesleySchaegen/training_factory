<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    private $passwordEncoder;

    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \Exception('This method can be blank - it will be intercepted by the logout key on your firewall');
    }


     public function __construct(UserPasswordEncoderInterface $passwordEncoder)
     {
         $this->passwordEncoder = $passwordEncoder;
     }


/**
     * @Route("/dummy", name="dummy_account")
     */
    public function dummy (EntityManagerInterface $em)
    {
       $user =  new User();
       $user->setLoginname('Jdik');
       $user->setRoles(["ROLE_INSTRUCT"]);
       $user->setPassword($this->passwordEncoder->encodePassword(
                        $user,
                        'hallo'
                    ));
       $user->setFirstname("Rick");
       $user->setLastname("Dikers");
       $user->setDateofbirth(new \DateTime("2002-06-25"));
       $user->setGender("male");
       $user->setStreet("Vrederustlaan");
       $user->setPostalCode("2543 TG");
       $user->setPlace("Den Haag");
       $user->setEmailadress("JanDikers@hotmail.nl");
       $user->setHiringDate("2010-06-30");
       $user->setSalary("20.00");
        $em->persist($user);
        $em->flush();
        $this->addFlash('succes', 'Training bewerkt');
        return $this->redirectToRoute('app_instructeur_homepage');
    }
}
