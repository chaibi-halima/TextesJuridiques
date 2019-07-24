<?php

namespace Culture\JuridiqueBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Culture\JuridiqueBundle\Entity\Domaine;
use Culture\JuridiqueBundle\Form\DomaineType;

class SousCategorie2Type extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {


        $builder
                ->add('domaine', EntityType::class, array(
                    'class' => 'CultureJuridiqueBundle:Domaine',
                    'placeholder' => '',
                    'multiple' => false,
                ))
        ;

        $formModifier = function (FormInterface $form, Domaine $domaine = null) {
            $souscategories = null === $domaine ? array() : $domaine->getSousCategorie1s();

            $form->add('souscategories', EntityType::class, array(
                'class' => 'CultureJuridiqueBundle:SousCategorie1',
                'placeholder' => '',
                'choices' => $souscategories,
                'choices_as_values' => true,
                    'multiple' => false,
            ));
        };

        $builder->addEventListener(
                FormEvents::PRE_SET_DATA, function (FormEvent $event) use ($formModifier) {
            // this would be your entity, i.e. SportMeetup
            $data = $event->getData();

            $formModifier($event->getForm(), $data->getDomaine());
        }
        );

        $builder->get('domaine')->addEventListener(
                FormEvents::POST_SUBMIT, function (FormEvent $event) use ($formModifier) {
            // It's important here to fetch $event->getForm()->getData(), as
            // $event->getData() will get you the client data (that is, the ID)
            $domaine = $event->getForm()->getData();

            // since we've added the listener to the child, we'll have to pass on
            // the parent to the callback functions!
            $formModifier($event->getForm()->getParent(), $domaine);
        }
        );
    

    /** $builder ->add('domaine', 'entity', array('class' => 'CultureJuridiqueBundle:Domaine',
      'label' => 'Domaine Culturel', 'property'=>'domaine', ))
      ->add('sousCategorie2');

      $factory = $builder->getFormFactory();

      $refreshSousCategorie = function ($form, $domaine) use ($factory) {
      $form->add($factory->createNamed('entity', 'SousCategorie1', null, array(
      'class' => 'CultureJuridiqueBundle:SousCategorie1',
      'property' => 'SousCategorie1',
      'label' => 'SousCategorie1',
      'query_builder' => function (EntityRepository $repository) use ($domaine) {
      $qb = $repository->createQueryBuilder('sous_categorie1');
      $qb = $qb->where('domaine.domaine.id = sous_categorie1.domaine_id');

      return $qb;
      }
      )));
      };

      $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) use ($refreshSousCategorie) {
      $form = $event->getForm();
      $data = $event->getData();

      if ($data == null)
      $refreshLocality($form, null); //As of beta2, when a form is created setData(null) is called first

      if ($data instanceof Province) {
      $refreshSousCategorie($form, $data->getDomaine()->getSousCategorie1s());
      }
      });

      $builder->addEventListener(FormEvents::PRE_BIND, function (DataEvent $event) use ($refreshSousCategorie) {
      $form = $event->getForm();
      $data = $event->getData();

      if (array_key_exists('SousCategorie1', $data)) {
      $refreshSousCategorie($form, $data['SousCategorie1']);
      }
      });
     * */
}

/**
 * {@inheritdoc}
 */
public function configureOptions(OptionsResolver $resolver) {
    $resolver->setDefaults(array(
        'data_class' => 'Culture\JuridiqueBundle\Entity\SousCategorie2'
    ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'culture_juridiquebundle_souscategorie2';
    }

}
