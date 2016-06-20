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
            ->add('nombre','text',array('attr' => array('class'=> 'form-control',
                'placeholder' =>'Nombre de la Subarea')))
            ->add('calificacionParcial',null,array('attr' => array('class'=> 'form-control',
                'placeholder' =>'Calificacion')))
            ->add('area', 'entity', array(
                'class' => 'AreasBundle:Area',
                'property' => 'nombre',
                'attr' => array(
                                'class'=> 'form-control',
                                'placeholder' =>'Seleciona el Area')))
            ->add('perfil', 'entity', array(
                'class' => 'AreasBundle:Perfil',
                'property' => 'nombre',
                'attr' => array(
                                'class'=> 'form-control',
                                'placeholder' =>'Seleciona el Perfil')))
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
