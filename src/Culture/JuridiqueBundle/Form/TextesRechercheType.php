<?php

// src/Culture/JuridiqueBundle/Form/TextesRechercheType.php

namespace Culture\JuridiqueBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Range;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateIntervalType;
use Culture\JuridiqueBundle\Repository\TexteJuridiqueRepository;

class TextesRechercheType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
                ->add('typetexte', 'entity', array('class' => 'CultureJuridiqueBundle:TypeTexte',
                    'label' => 'Type de Texte', 'property' => 'typeTexte','placeholder' => 'Choisir Type Texte','required'  => false))
                ->add('annee', 'Symfony\Component\Form\Extension\Core\Type\ChoiceType', array(
                    'choices' => $this->getYears(1956)
                    ,'choices_as_values' => true,
                    "mapped" => false,
                    'required'  => false ))
                ->add('numero','text', array('required'  => false))
                ->add('date', 'birthday', array('required'  => false))
                ->add('domaine', 'entity', array('class' => 'CultureJuridiqueBundle:Domaine',
                    'label' => 'Domaine Culturel', 'property' => 'domaine','placeholder' => 'Choisir Domaine Culturel','required'  => false))
                ->add('anneejort', 'Symfony\Component\Form\Extension\Core\Type\ChoiceType', array(
                    'choices' => $this->getYears(1956)
                    ,'choices_as_values' => true,
                    "mapped" => false,
                    'required'  => false ))

                ->add('jort', 'text', array( 'required'  => false))      


                 ->add('datejort', 'birthday', array(
                     "mapped" => false,'required'  => false
                ))
        ;
    }
    private function unique()
    {
         $numero=22;

         return $numero;
    }
    private function getYears($min, $max='current')
    {
         $years = range(($max === 'current' ? date('Y') : $max),$min);

         return array_combine($years, $years);
    }
    public function getName() {

        return 'culture_juridiquebundle_recherchetextes';
    }

}
