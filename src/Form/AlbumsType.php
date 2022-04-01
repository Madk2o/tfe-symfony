<?php

namespace App\Form;

use App\Entity\Albums;
use App\Entity\Artists;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AlbumsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('artistid',
            EntityType::class,[
                'class'=> Artists::class,
               'choice_label'=> 'name',
               'multiple'=>false,//pour en cocher plusieurs
               'expanded'=>false//pour en cocher plusieurs
               /* ,'query_builder'=>function(BreedRepository $repo){
                    return $repo->find
                }*/
            ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Albums::class,
        ]);
    }
}
