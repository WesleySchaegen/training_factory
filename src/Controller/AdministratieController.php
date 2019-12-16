<?php


namespace App\Controller;


use App\Entity\Training;
use App\Form\RegisFromType;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdministratieController extends AbstractController
{
    /**
     * @Route("/admin/trainingen", name="app_admin_trainingen")
     */
    public function newTraining(Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(RegisFromType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $training = $form->getData();
            $em->persist($training);
            $em->flush();
            $this->addFlash('succes', 'Training aangemaakt');
            return $this->redirectToRoute('app_bezoek_homepage');
        }

        return $this->render('screen/admin/trainingen.html.twig',
            ['regisForm' => $form->createView()]);
    }
}