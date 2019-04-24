<?php

namespace App\Form;

use App\Entity\Museum;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MuseumFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nameMuseum')
            ->add('histoireMuseum')
            ->add('imageMuseum')
            //->add('slug')
            ->add('oeuvres')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Museum::class,
        ]);
    }
}
