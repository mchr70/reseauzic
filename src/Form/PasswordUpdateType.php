<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class PasswordUpdateType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('newPassword', PasswordType::class, $this->getConfiguration("Entrez votre nouveau mot de passe", ""))
        ->add('confirmPassword', PasswordType::class, $this->getConfiguration("Confirmez votre mot de passe", ""))
        ->add('submit', SubmitType::class, ['label'=>'Envoyer', 'attr'=>['class'=>'btn-primary btn-block']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
