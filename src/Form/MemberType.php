<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Genre;
use App\Entity\Instrument;
use App\Entity\UserInstrument;
use App\Repository\GenreRepository;
use App\Repository\InstrumentRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

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
                                                'expanded' => true,
                                                'required' => false            ])
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
            ->add('instruments', EntityType::Class, array(
                    'class' => Instrument::Class,
                    'choice_label' => 'name',
                    'label' => 'Instruments pratiqués',
                    'expanded' => true,
                    'multiple' => true,
                    'query_builder'=>function(InstrumentRepository $ir){
                        return $ir ->createQueryBuilder('i')->orderBy('i.name','ASC');}
                ) 
            )                                                                              
            ->add('genres', EntityType::Class, array(
                    'class' => Genre::Class,
                    'choice_label' => 'name',
                    'label' => 'Genres de musique pratiqués',
                    'expanded' => true,
                    'multiple' => true,
                    'query_builder'=>function(GenreRepository $gr){
                        return $gr ->createQueryBuilder('g')->orderBy('g.name','ASC');}
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
