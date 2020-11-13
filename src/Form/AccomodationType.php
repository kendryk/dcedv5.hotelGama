<?php

namespace App\Form;

use App\Entity\Accomodation;
use App\Entity\Amenity;
use App\Entity\Category;
use App\Entity\Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
                'mapped' => true,
                'attr' => ['class' => 'm-1'],
                'required' => true,
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

            ->add('beds', IntegerType::class,[
                "label"=> 'Nombre de lits',
                'attr' => ['class' => 'm-1'],
                ])

            ->add('persons', IntegerType::class,[
                "label"=> 'Nombre de personnes',
                'attr' => ['class' => 'm-1'],
            ])

            ->add('size', IntegerType::class,[
                "label"=> 'taille de la chambre',
                'attr' => ['class' => 'm-1'],
            ])

            ->add('price', TextType::class, [
                "label"=> 'Coût de la location',
                'attr' => ['class' => 'm-1'],

            ])

            ->add('description', TextareaType::class, [
                "label"=> 'Description',
                'attr' => ['class' => 'm-3'],

            ])

            ->add('type',EntityType::class,[
                'class' => Type::class,
                'choice_label' => 'Name',
                'required'      => true,
                'expanded'=> true,
                'label' => 'Choisir le style',
                'attr' => [
                    'class' => 'm-1',
                    'maxlength' => 255

                ],


            ])

            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'Name',
                'required'      => true,
                'expanded' => true,
                'label' => 'Choisir la categorie',
                'attr' => ['class' => 'm-1'],
            ])

            ->add('amenity',EntityType::class,[
                'class' => Amenity::class,
                'choice_label' => 'Name',
                'label'=> 'Amenity',
                'expanded' => true,
                'multiple' => true,
                'attr' => ['class' => 'm-1'],


            ])










        ;


    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Accomodation::class,

        ]);
    }
}
