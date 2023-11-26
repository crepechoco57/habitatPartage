<?php

namespace App\Form;

use App\Entity\Departement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Repository\DepartementRepository;

class VilleSearchType extends AbstractType
{
    private $departementRepository;

    public function __construct(DepartementRepository $departementRepository)
    {
        $this->departementRepository = $departementRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $departements = $this->departementRepository->findAllDepartements();

        $choices = [];
        foreach ($departements as $departement) {
            $choices[$departement->getNom()] = $departement->getCode();
        }

        $builder
            ->add('departement', ChoiceType::class, [
                'choices' => $choices,
                'label' => 'Choisissez le département',
            ]);
    }
    // public function buildForm(FormBuilderInterface $builder, array $options)
    // {
    //     $builder
    //         ->add('departement', ChoiceType::class, [
    //             'choices' => [
    //                 'Département 1' => '01',
    //                 'Département 2' => '02',
    //                 // ... Ajoutez les départements nécessaires ici
    //             ],
    //             'label' => 'Choisissez le département',
    //         ]);
    // }

    // public function configureOptions(OptionsResolver $resolver)
    // {
    //     $resolver->setDefaults([
    //         // configurez les options du formulaire si nécessaire
    //     ]);
    // }
}