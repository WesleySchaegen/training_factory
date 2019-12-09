<?php


namespace App\Controller;


use App\Form\RegisFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
        return $this->render('screen/bezoeker/trainingbod.html.twig');
    }
    /**
     * @Route("/bezoeker/registreren", name="app_bezoek_lidword")
     */
    public function lidword()
    {
        return $this->render('screen/bezoeker/registreren.html.twig');
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