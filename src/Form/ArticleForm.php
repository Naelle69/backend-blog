<?php

// src/Form/ArticleFormType.php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File as FileConstraint;

class ArticleForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, ['label' => 'Titre'])
            ->add('subtitle', TextType::class, ['label' => 'Sous-titre'])
            ->add('content', TextareaType::class, ['label' => 'Contenu'])
            ->add('slug', TextType::class, ['label' => 'Slug (URL)', 'required' => false])
            // ->add('publishedAt', DateTimeType::class, [
            //     'label' => 'Date de publication',
            //     'widget' => 'single_text',
            //     'required' => false,
            // ])
            ->add('readingTime', IntegerType::class, ['label' => 'Durée de lecture (minutes)'])
            ->add('isPublished', CheckboxType::class, [
                'label' => 'Publié ?',
                'required' => false,
            ])
            ->add('imageFile', FileType::class, [
                'label' => 'Image principale (JPG/PNG/GIF)',
                'required' => false,
                'constraints' => [
                    new FileConstraint([
                        'maxSize' => '5M',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/gif',
                            'image/jpg',
                        ],
                        'mimeTypesMessage' => 'Veuillez télécharger une image valide (JPEG, PNG ou GIF)',
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => \App\Entity\Article::class,
        ]);
    }
}
