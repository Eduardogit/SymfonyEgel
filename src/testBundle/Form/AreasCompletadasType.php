<?php

namespace testBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AreasCompletadasType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('entornoSocial')
            ->add('matematicas')
            ->add('arquitectura')
            ->add('redes')
            ->add('software')
            ->add('ingSoftware')
            ->add('graficacion')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'testBundle\Entity\AreasCompletadas'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'testbundle_areascompletadas';
    }
}
