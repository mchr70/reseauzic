<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Genre;
use App\Entity\Instrument;
use App\Entity\UserSearch;
use App\Repository\GenreRepository;
use App\Repository\InstrumentRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class UserSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('zipCode', TextType::class, [
                'label' => 'Code postal',
                'required' => false
            ]) 
            ->add('instruments', EntityType::Class, array(
                 'class' => Instrument::Class,
                 'choice_label' => 'name',
                 'label' => 'Instruments pratiqués',
                 'expanded' => true,
                 'multiple' => true,
                //  'mapped' => false,
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
                 'mapped' => false,
                 'query_builder'=>function(GenreRepository $gr){
                     return $gr->createQueryBuilder('g')->orderBy('g.name','ASC');}
                 )
            )
            
            ->add('submit', SubmitType::class, [
                    'label' => 'Rechercher'           
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserSearch::class,
            'method' => 'get',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix(){
        return '';
    }
}
