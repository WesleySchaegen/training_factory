<?php


namespace App\Controller;


use App\Entity\Training;
use App\Form\TrainFromType;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdministratieController extends AbstractController
{
    /**
     * @Route("/admin/home", name="app_admin_homepage")
     */

    public function adhomepage()
    {
        return $this->render('screen/admin/home.html.twig');
    }

    /**
     * @Route("/admin/instructeurs", name="app_admin_instructeurs")
     */

    public function adinstructeurs()
    {
        return $this->render('screen/admin/instructeurs.html.twig');
    }

    /**
 * @Route("/admin/leden", name="app_admin_leden")
 */

    public function adleden()
    {
        return $this->render('screen/admin/leden.html.twig');
    }

    /**
     * @Route("/admin/training", name="app_admin_training")
     */

    public function adtraining()
    {
        $em = $this->getDoctrine()->getManager();
        $trainingen = $em->getRepository(Training::class)->findAll();
        return $this->render('screen/admin/trainingpage.html.twig',["trainingen"=>$trainingen]);
    }

    /**
     * @Route("/admin/trainingen", name="app_admin_trainingen")
     */
    public function newTraining(Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(TrainFromType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $training = $form->getData();
            $em->persist($training);
            $em->flush();
            $this->addFlash('succes', 'Training aangemaakt');
            return $this->redirectToRoute('app_admin_training');
        }

        return $this->render('screen/admin/trainingen.html.twig',
            ['trainForm' => $form->createView()]);
    }

    /**
     * @Route("/admin/trainingaanpas/{id}", name="app_admin_trainingaanpas")
     */
    public function aanpas($id, Request $request, EntityManagerInterface $em)
    {
        $trainingObject =  $em->getRepository(Training::class)->find($id);
        $form = $this->createForm(TrainFromType::class, $trainingObject);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $training = $form->getData();
            $em->persist($training);
            $em->flush();
            $this->addFlash('succes', 'Training bewerkt');
            return $this->redirectToRoute('app_admin_training');
        }

        return $this->render('screen/admin/trainingen.html.twig',
            ['trainForm' => $form->createView()]);
    }
}