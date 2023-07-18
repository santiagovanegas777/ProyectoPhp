<?php

namespace App\Form;

use App\Entity\Character;
use App\Entity\Episode;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CharacterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null,[
                'label'=>'NAME',
                'attr' => ['placeholder'=>'Pon aqui el nombre del character']

            ])
            ->add('species',null,[
                'attr' => ['placeholder'=>'Pon aqui la especie']
            ])
            ->add('image',null,[
                'attr' => ['placeholder'=>'Carga una imagen']
            ])
            ->add('gender',null,[
                'attr' => ['placeholder'=>'Pon aqui el gender del character']
            ])
             ->add('episodes', EntityType::class,[
                'class' =>Episode::class,
                'choice_label'=> 'episode',
                'multiple'=>true,
             ])
            ->add('Enviar', SubmitType::class);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Character::class,
        ]);
    }
}
