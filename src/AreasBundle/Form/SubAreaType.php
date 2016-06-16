<?php

namespace AreasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SubAreaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('calificacionParcial')
            ->add('area', 'entity', array(
                'class' => 'AreasBundle:Area',
                'property' => 'nombre',
                ))
            ->add('perfil', 'entity', array(
                'class' => 'AreasBundle:Perfil',
                'property' => 'nombre',
                ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AreasBundle\Entity\SubArea'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'areasbundle_subarea';
    }
}
