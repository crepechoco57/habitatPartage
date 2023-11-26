<?php

namespace App\Form;

use App\Entity\Ad;
use App\Entity\Ville;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class PostAdType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('text')
            ->add('villeId', TextType::class, [
                'mapped' => false, 
            ]);
            // ->add('ville', EntityType::class, [
            //     'class' => Ville::class,
            //     'choice_label' => 'nom', // ou tout autre champ que vous souhaitez afficher
            //     // d'autres options au besoin
            // ]);
  
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ad::class,
        ]);
    }
}
