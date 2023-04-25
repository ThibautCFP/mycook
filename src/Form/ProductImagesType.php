<?php

namespace App\Form;

use App\Entity\ProductImages;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductImagesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'imageFile',
                VichImageType::class,
                [
                    'required' => false,
                    'download_uri' => false,
                    'image_uri' => true,
                    'asset_helper' => true,
                    'label' => 'Image',
                    'delete_label' => "Supprimer l'image"
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProductImages::class,
        ]);
    }
}
