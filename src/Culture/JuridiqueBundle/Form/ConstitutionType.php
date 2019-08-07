<?php

namespace Culture\JuridiqueBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ConstitutionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('titre','text', array('required'  => false))
                ->add('date', 'birthday', array('required'  => false))
                ->add('brochure', FileType::class, array('label' => 'Brochure (PDF file)', 'required' => false,'data_class' => null))
                ->add('statuttexte', 'entity', array('class' => 'CultureJuridiqueBundle:StatutTexte',
                      'label' => 'Statut de Texte', 'property'=>'statutTexte', ))
                ->add('contenu', 'textarea', array('attr' => array('cols' => 20, 'rows' => 8) ,'required'  => false));
     
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Culture\JuridiqueBundle\Entity\Constitution'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'culture_juridiquebundle_constitution';
    }


}
