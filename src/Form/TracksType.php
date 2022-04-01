<?php

namespace App\Form;

use App\Entity\Albums;
use App\Entity\Genres;
use App\Entity\MediaTypes;
use App\Entity\Playlists;
use App\Entity\Tracks;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TracksType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('composer')
            ->add('milliseconds')
            ->add('bytes')
            ->add('unitprice')
            ->add('albumid', EntityType::class,[
                'class'=> Albums::class,
               'choice_label'=> 'title',
               'error_mapping' => [
                '.' => 1,
            ],
               'multiple'=>false,//pour en cocher plusieurs
               'expanded'=>false//pour en cocher plusieurs
               /* ,'query_builder'=>function(BreedRepository $repo){
                    return $repo->find
                }*/
            ])
            ->add('mediatypeid', EntityType::class,[
                'class'=> MediaTypes::class,
               'choice_label'=> 'name',
               'multiple'=>false,//pour en cocher plusieurs
               'expanded'=>false//pour en cocher plusieurs
               /* ,'query_builder'=>function(BreedRepository $repo){
                    return $repo->find
                }*/
            ])
            ->add('genreid', EntityType::class,[
                'class'=> Genres::class,
               'choice_label'=> 'name',
               'multiple'=>false,//pour en cocher plusieurs
               'expanded'=>false//pour en cocher plusieurs
               /* ,'query_builder'=>function(BreedRepository $repo){
                    return $repo->find
                }*/
            ])
            ->add('playlistid', EntityType::class,[
                'class'=> Playlists::class,
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
            'data_class' => Tracks::class,
        ]);
    }
}
