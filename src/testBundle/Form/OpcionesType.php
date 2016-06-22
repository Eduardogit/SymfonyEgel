<?php

namespace testBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class OpcionesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           /* ->add('pregunta','entity',array(
                'class' =>'testBundle:Preguntas',
                'property' => 'pregunta' ))*/
            ->add('opcion','text',array('attr' => array('class'=> 'form-control',
                'placeholder' =>'ingresa una opcion a la pregunta'
                )))
            ->add('valor','choice',array(
                'choices'=>array(
                    'a' => 'a',
                    'b' => 'b',
                    'c' => 'c',
                    'd' => 'd',
                    ),
                'attr' => array(
                    'class' => 'form-control'
                    )
                ))
            
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'testBundle\Entity\Opciones'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'testbundle_opciones';
    }
}
