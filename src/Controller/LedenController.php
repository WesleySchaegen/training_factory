<?php


namespace App\Controller;

use App\Entity\Training;
use App\Form\RegisFormType;
use App\Form\TrainFromType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LedenController extends AbstractController
{

    /**
     * @Route("/leden/home", name="app_leden_homepage")
     */

    public function lidhomepage()
    {
        return $this->render('screen/leden/home.html.twig');
    }
}