<?php

namespace App\Form;

use App\Entity\Accomodation;
use App\Entity\Booking;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date_start',DateType::class,['label' => 'Date de départ'])
            ->add('date_end',DateType::class,['label' => 'Date de fin '])
            ->add('user',EntityType::class,[
                'class' => user::class,
                 'label' => 'Utilisateur'])

            ->add('accomodation',EntityType::class,[
                'class' => accomodation::class,
                'label' => 'logement demandé'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Booking::class,
        ]);
    }
}
