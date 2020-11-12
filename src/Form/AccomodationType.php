<?php

namespace App\Form;

use App\Entity\Accomodation;
use App\Entity\Category;

use App\Entity\Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;


class AccomodationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('photo',FileType::class , [
                'label' => 'Photo',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/*',
                        ],
                        'mimeTypesMessage' => 'Sélectionnez une image au format .jpg ou .png',
                    ])
                ],
            ])

            ->add('beds')
            ->add('persons')
            ->add('size')
            ->add('price')
            ->add('description')

            //->add('type',EntityType::class,[
             //   'choice_label' => 'type',
            //    'class' => Type::class,
            //    'multiple' => true,
            //    'expanded'=> true,
            //    'label' => 'Choose Type',
            //])

            //->add('category', EntityType::class, [
             //   'class' => Category::class,
            //    'multiple' => true,
             //   'expanded' => true
           // ])

            //->add('amenity')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Accomodation::class,
        ]);
    }
}
