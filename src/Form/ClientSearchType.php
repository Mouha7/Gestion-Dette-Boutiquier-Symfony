<?php

namespace App\Form;

use App\Entity\ClientSearchDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ClientSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('searchTerm', TextType::class, [
            'attr' => [
                'class' => 'input input-bordered bg-gray-100 w-24 md:w-auto',
                'placeholder' => 'Rechercher par nom ou téléphone',
            ],
            'label' => false,
            'required' => false,
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ClientSearchDTO::class,
        ]);
    }
}
