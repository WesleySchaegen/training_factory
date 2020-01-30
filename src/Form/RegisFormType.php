<?php


namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $date = date('Y');
        $datePast = date('Y', strtotime('-80 years'));
        $builder
            ->add('loginname', null, ["label" => "Gebruikersnaam"])
            ->add('password', null, ["label" => "Wachtwoord"])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => ["label"=> "Wachtwoord"],
                'second_options' => ["label"=>"Herhaal wachtwoord"]])
            ->add('firstname', null, ["label" => "Voornaam"])
            ->add('preprovision', null, ["label" => "Tussenvoegsel"])
            ->add('lastname', null, ["label" => "Achternaam"])
            ->add('dateofbirth', DateType::class, ['years' => range($datePast, $date), 'format' => 'dd MM yyyy', "label" => 'Geboortedatum'])
            ->add('gender', ChoiceType::class,[
                'choices' =>[
                    'Man'=> 'Male',
                    'Vrouw'=>'Female',
                    'Andere' =>'Other'
                ], "label" => "Geslacht"])
            ->add('street', null, ["label" => "Straat"])
            ->add('postalcode', null, ["label" => "Postcode"])
            ->add('place', null, ["label" => "Plaats"])
            ->add('emailadress', EmailType::class, ["label" => "Email"]);
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'App\Entity\User'
        ]);
    }
}