<?php

namespace App\Form;

use App\Entity\AppUser;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserFormType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('enabled', null, [
                'label'=>"L'utilisateur est-il activé?"
            ])
            ->add('roles', ChoiceType::class, [
                'choices'=> [
                    "Membre" => "ROLE_MEMBRE",
                    "Modérateur Musée" => "ROLE_MUSEUM",
                    "Modérateur" => "ROLE_MODERATEUR",
                    "Administrateur" => "ROLE_ADMIN",
                ],
                "multiple" => true,
                "expanded" => true
            ]);
            //->add('username')
            //->add('usernameCanonical')
            //->add('email')
            //->add('emailCanonical')
            //->add('enabled')
            //->add('salt')
            //->add('password')
            //->add('lastLogin')
            //->add('confirmationToken')
            //->add('passwordRequestedAt')
            //->add('roles')
            //->add('age')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AppUser::class,
        ]);
    }
}
