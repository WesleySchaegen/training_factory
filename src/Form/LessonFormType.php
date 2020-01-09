<?php


namespace App\Form;


use App\Entity\Training;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LessonFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', null, ["label" => "Datum"])
            ->add('time', null, ["label" => "Tijd"])
            ->add('training', EntityType::class,
                [
                    'class' => Training::class,
                    'choice_label' => 'naam',
                    "label" => "Sport"
                ])
            ->add('location', null, ["label" => "Lokaal"])
            ->add('maxPersons', null, ["label" => "Maximaal aantal deelnemers"]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'App\Entity\Lesson'
        ]);
    }
}