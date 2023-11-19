<?php

namespace App\Form;

use App\Entity\Departement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class LocationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('departement', EntityType::class, [
                'class' => Departement::class,
                'choice_label' => 'nom',
                'label' => 'Sélectionnez un département',
                'choice_value' => 'code'
            ])
            ->add('villeSearch', TextType::class, [
                'label' => 'Rechercher une ville',
                'attr' => ['placeholder' => 'Rechercher une ville'],
                
            ])
            ->add('villeId', TextType::class, [
                'label' => 'Id de la ville',
                'attr' => ['placeholder' => 'Id de la ville'],
            ]);
        // Ajoutez d'autres champs si nécessaire
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configurez vos options ici si nécessaire
        ]);
    }
}
