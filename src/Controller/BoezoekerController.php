<?php


namespace App\Controller;


use App\Entity\Training;
use App\Form\RegisFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class BoezoekerController extends AbstractController
{

    /**
     * @Route("/", name="app_bezoek_homepage")
     */

    public function homepage()
    {
        return $this->render('screen/bezoeker/home.html.twig');
    }
    /**
     * @Route("/bezoeker/aanbod", name="app_bezoek_aanbod")
     */
    public function aanbod()
    {
        $em = $this->getDoctrine()->getManager();
        $trainingen = $em->getRepository(Training::class)->findAll();
        return $this->render('screen/bezoeker/trainingbod.html.twig',["trainingen"=>$trainingen]);
    }



    /**
     * @Route("/bezoeker/registreren", name="app_bezoek_lidword")
     */
    public function lidword(Request $request, EntityManagerInterface $em, UserPasswordEncoderInterface $encoder)
    {
        $form = $this->createForm(RegisFormType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $lid = $form->getData();
            $lid->setRoles(["ROLE_MEMBER"]);
            $lid->setPassword($encoder->encodePassword(
                $lid,
                    $lid->getPassword()
            ));
            $em->persist($lid);
            $em->flush();
            $this->addFlash('succes', 'Account aangemaakt');
            return $this->redirectToRoute('app_login');
        }

        return $this->render('screen/bezoeker/registreren.html.twig',
            ['regisForm' => $form->createView()]);
    }
    /**
     * @Route("/bezoeker/gedragsregels", name="app_bezoek_gregels")
     */
    public function gregels()
    {
        return $this->render('screen/bezoeker/gedragsregels.html.twig');
    }
    /**
     * @Route("/bezoeker/lokatie&contact", name="app_bezoek_locatie")
     */
    public function locatie()
    {
        return $this->render('screen/bezoeker/lokatiecontact.html.twig');
    }
}