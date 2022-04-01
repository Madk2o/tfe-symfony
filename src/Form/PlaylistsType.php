<?php

namespace App\Form;

use App\Entity\Tracks;
use App\Entity\Playlists;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlaylistsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('trackid', EntityType::class,[
                'class'=> Tracks::class,
               'choice_label'=> 'name',
               'multiple'=>true,//pour en cocher plusieurs
               'expanded'=>true//pour en cocher plusieurs
               /* ,'query_builder'=>function(BreedRepository $repo){
                    return $repo->find
                }*/
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Playlists::class,
        ]);
    }
}
