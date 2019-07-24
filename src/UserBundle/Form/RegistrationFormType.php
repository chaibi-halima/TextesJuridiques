<?php
 
namespace UserBundle\Form;
 
use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;
 
class RegistrationFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder->add('family_name','text',array('label' => 'Nom de la Famille', 'required' => false));     
        $builder->add('enabled','checkbox',array('label' => 'Activé', 'required' => false));     
    }
 
    public function getName()
    {
        return 'userbundle_register';
    }
}