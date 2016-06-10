<?php

namespace testBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PreguntasType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('descripcion'  ,'text',array('attr' => array('class'=> 'form-control',
                'placeholder' =>'ingresa la descripcion de la pregunta'
                )))
            ->add('pregunta'  ,'text',array('attr' => array('class'=> 'form-control',
                'placeholder' =>'Ingresa tu pregunta'
                )))
            ->add('respuestaCorrecta'   ,'text',array('attr' => array('class'=> 'form-control',
                'placeholder' =>'Ingresa tu respuesta correcta'
                )))
            ->add('subarea', 'entity', array(
                'class' => 'AreasBundle:SubArea',
                'property' => 'nombre',
                'attr' => array(
                        'class'=> 'form-control',
                        'placeholder' =>'Seleciona la subarea')))
            ->add('opciones',new OpcionesType())

        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'testBundle\Entity\Preguntas'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'testbundle_preguntas';
    }
}
