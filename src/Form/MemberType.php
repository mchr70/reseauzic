<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Instrument;
use App\Entity\Genre;
use App\Entity\UserInstrumentLevel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
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
            ->add('gender', ChoiceType::Class, ['label' => 'Sexe', 
                                                'choices' => [
                                                    'Homme' => 1,
                                                    'Femme' => 0,
                                                ],
            ])
            ->add('zipCode', TextType::Class, ['label' => 'Code postal'])
            ->add('city', TextType::Class, ['label' => 'Ville'])
            ->add('address', TextareaType::Class, ['label' => 'Adresse'])
            ->add('phone', TextType::Class, ['label' => 'Téléphone'])
            ->add('about', TextareaType::Class, ['label' => 'Description'])   
            ->add('influences', TextareaType::Class, ['label' => 'Influences']) 
            ->add('material', TextareaType::Class, ['label' => 'Matériel']) 
            ->add('userInstrumentLevels', EntityType::class, array( 
                'class'        => UserInstrumentLevel::class, //This existed usually in (App\Entity\Instrument),
                'choice_label' => 'instrument.name',
                /* 'query_builder' => function(InstrumentRepository $ir) {
                    return $ir->findAll();
                }, */
                'label' => 'Instruments pratiqués',
                'expanded' => true,
                'multiple' => true
            ))
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
