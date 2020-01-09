<?php


namespace App\Controller;


use App\Entity\Lesson;
use App\Entity\Training;
use App\Form\LessonFormType;
use App\Form\TrainFromType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class InstructeurController extends AbstractController
{
    /**
     * @Route("/instructeur/home", name="app_instructeur_homepage")
     */
    public function inhomepage()
    {
        return $this->render('screen/instructeur/home.html.twig');
    }

    /**
     * @Route("/instructeur/lesbeheer", name="app_instructeur_lesbeheren")
     */
    public function inlesbeheer()
    {
        $em = $this->getDoctrine()->getManager();
        $lessons = $em->getRepository(Lesson::class)->findAll();
        return $this->render('screen/instructeur/lesbeheren.html.twig',["lessons"=>$lessons]);
    }

    /**
     * @Route("/instructeur/plannen", name="app_instructeur_plannen")
     */
    public function newTraining(Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(LessonFormType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $lesson = $form->getData();
            $em->persist($lesson);
            $em->flush();
            $this->addFlash('succes', 'Lesson aangemaakt');
            return $this->redirectToRoute('app_instructeur_lesbeheren');
        }

        return $this->render('screen/instructeur/plannen.html.twig',
            ['lessonForm' => $form->createView()]);
    }

    /**
     * @Route("/instructeur/lessenaanpas/{id}", name="app_instructeur_lessenaanpas")
     */
    public function aanpas($id, Request $request, EntityManagerInterface $em)
    {
        $trainingObject =  $em->getRepository(Lesson::class)->find($id);
        $form = $this->createForm(LessonFormType::class, $trainingObject);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $lesson = $form->getData();
            $em->persist($lesson);
            $em->flush();
            $this->addFlash('succes', 'Lessen bewerkt');
            return $this->redirectToRoute('app_instructeur_lesbeheren');
        }

        return $this->render('screen/instructeur/lesbeheren.html.twig',
            ['lessonForm' => $form->createView()]);
    }

    /**
     * @Route("/admin/lessendelete/{id}", name="app_admin_lessondelete")
     */
    public function delete($id, Request $request, EntityManagerInterface $em)
    {
        $lessonObject = $em->getRepository(Lesson::class)->find($id);
        $em->remove($lessonObject);
        $em->flush();
        $this->addFlash('succes', 'lesson verwijderd');
        return $this->redirectToRoute('app_instructeur_lesbeheren');
    }
}