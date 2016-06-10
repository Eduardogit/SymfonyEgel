<?php

namespace AreasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AreaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre' ,'text',array('attr' => array('class'=> 'form-control',
                'placeholder' =>'Nombre del area')))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AreasBundle\Entity\Area'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'areasbundle_area';
    }
}
