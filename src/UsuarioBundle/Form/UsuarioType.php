<?php

namespace UsuarioBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UsuarioType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username'       ,'text',array('attr' => array('class'=> 'form-control',
                'placeholder' =>'username'
                )))
            ->add('password'       ,'password',array('attr' => array('class'=> 'form-control',
                'placeholder' =>'password'
                )))
            ->add('correo'         ,'email',array('attr' => array('class'=> 'form-control',
                'placeholder' =>'correo'
                )))
            ->add('nombre'         ,'text',array('attr' => array('class'=> 'form-control',
                'placeholder' =>'nombre'
                )))
            ->add('apPaterno'      ,'text',array('attr' => array('class'=> 'form-control',
                'placeholder' =>'apellido paterno'
                )))
            ->add('apMaterno'      ,'text',array('attr' => array('class'=> 'form-control',
                'placeholder' =>'apellido materno'
                )))
            ->add('fechaNacimiento', 'date' ,array(
                'widget'=> 'single_text',
                'format'=>'M/d/y','attr' => array('class'=> 'form-control datepicker-here',
                'placeholder' =>'selecciona tu fecha de nacimiento',
                'data-language' => 'en',
                )))
            ->add('sexo'           ,'choice',array(
                'choices' => array(
                    'masculino' => 'masculino',
                    'femenino' => 'femenino',
                    ),
                    'attr' => array(
                        'class'=> 'form-control',
                        'placeholder' =>'Seleciona tu sexo'

                     )))
            ->add('domicilio'     ,'text',array('attr' => array('class'=> 'form-control',
                'placeholder' =>'domicilio'
                )))
            ->add('municipio'     ,'text',array('attr' => array('class'=> 'form-control',
                'placeholder' =>'municipio'
                )))
            ->add('estado'        ,'text',array('attr' => array('class'=> 'form-control',
                'placeholder' =>'estado'
                )))
            ->add('matricula'     ,'integer',array('attr' => array('class'=> 'form-control',
                'placeholder' =>'matricula'
                )))
            ->add('perfil', 'entity', array(
               'class' => 'AreasBundle:Perfil',
               'property' => 'nombre',
                'attr' => array(
                    'class' => 'form-control'
                )))
            ->add('role','hidden', array(
                        'attr' => array(
                        'required' => false
                        )))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UsuarioBundle\Entity\Usuario'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'usuariobundle_usuario';
    }
}
