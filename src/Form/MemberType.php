<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Instrument;
use App\Entity\Genre;
use App\Entity\UserInstrument;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class MemberType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('birthDate', BirthdayType::Class, ['label' => 'Date de naissance'])
            ->add('plainPassword', HiddenType::Class, ['data' => 'abcdf'])
            ->add('gender', ChoiceType::Class, ['label' => 'Sexe', 
                                                'choices' => [
                                                    'Homme' => 1,
                                                    'Femme' => 0,
                                                ],
            ])
            ->add('zipCode', TextType::Class, ['label' => 'Code postal', 
                                               'required' => false])
            ->add('city', TextType::Class, ['label' => 'Ville',
                                               'required' => false])
            ->add('address', TextareaType::Class, ['label' => 'Adresse',
                                                   'required' => false])
            ->add('phone', TextType::Class, ['label' => 'Téléphone',
                                             'required' => false])
            ->add('about', TextareaType::Class, ['label' => 'Description',
                                                 'required' => false])   
            ->add('influences', TextareaType::Class, ['label' => 'Influences',
                                                      'required' => false])
            ->add('material', TextareaType::Class, ['label' => 'Matériel',
                                                    'required' => false])
            ->add('genres', EntityType::Class, array(
                    'class' => Genre::Class,
                    'choice_label' => 'name',
                    'label' => 'Genres de musique pratiqués',
                    'expanded' => true,
                    'multiple' => true
                ) 
            )
            ->add('submit', SubmitType::class, ['label' => 'Sauvegarder les modifications'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
