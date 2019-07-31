<?php

namespace Culture\JuridiqueBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Culture\JuridiqueBundle\Form\TypeTexteType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class TexteJuridiqueType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
        ->add('typetexte', 'entity', array('class' => 'CultureJuridiqueBundle:TypeTexte',
        'label' => 'Type de Texte', 'property' => 'typeTexte', ))
        ->add('numero', 'text', array('required' => false))
        ->add('date', DateType::class, array(
                
                'format' => 'yyyy-MM-dd', 
                'choice_translation_domain'=> false,
                'years' => range(date('Y'), date('Y') - 120)
            ))
            
    
        ->add('sujet')
        ->add('brochure', FileType::class, array('label' => 'Brochure (PDF file)','required' => true, 'data_class' => null))
        ->add('domaine', 'entity', array('class' => 'CultureJuridiqueBundle:Domaine',
        'label' => 'Domaine Culturel', 'property' => 'domaine', ))
        ->add('contenu', 'textarea', array('attr' => array('cols' => 20, 'rows' => 5) ))
        ->add('statuttexte', 'entity', array('class' => 'CultureJuridiqueBundle:StatutTexte',
        'label' => 'Statut de Texte', 'property' => 'statutTexte', ))
        ->add('jort', 'text',  array('required' => false))
        ->add('nomination', CheckboxType::class, array(
        'label' => 'Nomination',
        'required' => false,))
        
        ->add('date_jort', DateType::class, array(
            'required' => false,
            'format' => 'yyyy-MM-dd', 
            'choice_translation_domain'=> false,
            'years' => range(date('Y'), date('Y') - 120)
        ))
        ;
        
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Culture\JuridiqueBundle\Entity\TexteJuridique'
        ));
    }

}
