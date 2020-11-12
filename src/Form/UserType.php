<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder


            ->add('first_name',TextType::class,['label'=> ' Nom de famille'])
            ->add('last_name',TextType::class,['label'=> ' Prénom'])

            ->add('email')

            ->add('password', RepeatedType::class,[
                'type'=> PasswordType::class,
                'first_options'=> ['label'=> ' Mot de passe'],
                'second_options'=>['label'=> 'répétez le mot de passe']
            ])


        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
