<?php

namespace App\Form;

use App\Entity\Annonce;
use App\Entity\Categorie;
use App\Entity\SousCategorie;
use Symfony\Component\Form\AbstractType;
use App\Repository\SousCategorieRepository;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class AnnonceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        
        $cat = $options["data"]->getCategorie();
        if ($cat != null) {
            $cat = $options["data"]->getCategorie()->getId();
        }
        $builder
            ->add('titre', TextType::class, [
                'label' => "Titre *",
                'attr' => [
                    'placeholder' => 'ex. Pantalon'
                    ]
                ])
            ->add('imageFile', FileType::class, ['label' => 'Image', 'required' => false])
            ->add('description', CKEditorType::class, [
                "label" => "Description",
                'required' => false
                ])
            ->add('prix')
            ->add('isActive', CheckboxType::class, ['label' => "Activée ?"])
            ->add(
                'sexe',
                ChoiceType::class,
                [
                    'choices' => [
                        'Pour Femme' => 'f',
                        'Pour Homme' => 'm',
                    ],
                    'expanded' => true,
                    "label" => "Sexe",
                    'required' => false
                ],
            )
            ->add('categorie', EntityType::class, [
                'class'=>Categorie::class, 
                "label"=>"Category",
                'required' => false
                ])
            // ->add('sousCategorie', EntityType::class, [
            //     'class'=>SousCategorie::class,
            //     'query_builder' => function (SousCategorieRepository $er) use ($cat) {
            //         return $er->createQueryBuilder('u')
            //             ->where('u.categorie = :val')
            //             ->setParameter('val', $cat);
            //     }, 
            //     "label"=>"Sous-categorie",
            //     'required' => false
            //     ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Annonce::class,
        ]);
    }
}
