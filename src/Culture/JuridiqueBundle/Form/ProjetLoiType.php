<?php

namespace Culture\JuridiqueBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

use Culture\JuridiqueBundle\Form\PhaseProjetType;

class ProjetLoiType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('sujet')
                 ->add('date', 'birthday')
                ->add('phaseprojet', 'entity', array('class' => 'CultureJuridiqueBundle:PhaseProjet',
                      'label' => 'Phase de Projet', 'property'=>'phase', ))
                ->add('contenu', 'textarea', array('attr' => array('cols' => 20, 'rows' => 8), 'required' => false))
                ->add('brochure', FileType::class, array('label' => 'Brochure (PDF file)','data_class' => null));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Culture\JuridiqueBundle\Entity\ProjetLoi'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'culture_juridiquebundle_projetloi';
    }


}
