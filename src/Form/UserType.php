<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        if($options['password']){
            $builder
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'empty_data' => '',
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ]);
        }
        if($options['user']){
            $builder
            ->add('email', EmailType::class, [
                'label' => 'Adresse e-mail',
                'empty_data' => ''
            ])
            ->add('nom', TextType::class, [
                'label' => 'Nom',
                'empty_data' => ''
            ])
            ->add('prenom', TextType::class, [
                'label' => 'Prenom',
                'empty_data' => ''
            ])
            ->add('pseudo', TextType::class, [
                'label' => 'Pseudo',
                'required' => false,
                'empty_data' => ''
            ]);
        }
        if($options['telephone']){
            $builder
            ->add('telephone', TextType::class, [
                'label' => 'Telephone',
                'empty_data' => ''
            ]);
        }
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'password' => false,
            'user' => false,
            'telephone' => false,
        ]);
    }
}
