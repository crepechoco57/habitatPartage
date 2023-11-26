<?php

namespace App\Form;

use App\Entity\Departement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
//Formulaire pour affichage des départements, d'un champs de recherche de ville, d'un champ de récup de l'id ville

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
            if ($options['show_submit_button']) {
                $builder->add('submit', SubmitType::class, [
                    'label' => 'Valider',
                ]);
            }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'show_submit_button' => false, // Valeur par défaut, ajustez selon vos besoins
            // Configurez vos options ici si nécessaire
        ]);
    }
}
