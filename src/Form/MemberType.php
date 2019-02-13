<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class MemberType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('zipCode', TextType::Class, ['label' => 'Code postal'])
            ->add('city', TextType::Class, ['label' => 'Ville'])
            ->add('address', TextareaType::Class, ['label' => 'Adresse'])
            ->add('phone', TextType::Class, ['label' => 'Téléphone'])
            ->add('about', TextareaType::Class, ['label' => 'Description'])   
            ->add('influences', TextareaType::Class, ['label' => 'Influences']) 
            ->add('material', TextareaType::Class, ['label' => 'Matériel']) 
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
