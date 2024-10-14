<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Client;
use SebastianBergmann\Type\TypeName;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('surname', TextType::class, [
                'attr' => [
                    'class' => 'input input-bordered flex items-center gap-2 bg-gray-100 shadow-inner shadow-gray-300',
                    'placeholder' => 'Surname',
                ],
                'label' => false,
            ])
            ->add('tel', TextType::class, [
                'attr' => [
                    'class' => 'input input-bordered flex items-center gap-2 bg-gray-100 shadow-inner shadow-gray-300',
                    'placeholder' => 'Tel',
                ],
                'label' => false,
            ])
            ->add('address', TextType::class, [
                'attr' => [
                    'class' => 'input input-bordered flex items-center gap-2 bg-gray-100 shadow-inner shadow-gray-300',
                    'placeholder' => 'Adresse',
                ],
                'label' => false,
            ])
            ->add('cumulMontantDu', TextType::class, [
                'attr' => [
                    'class' => 'input input-bordered flex items-center gap-2 bg-gray-100 shadow-inner shadow-gray-300',
                    'placeholder' => 'Montant',
                ],
                'label' => false,
            ])
            ->add('status', Label::class, [
                'attr' => [
                    'class' => 'input input-bordered flex items-center gap-2 bg-gray-100 shadow-inner shadow-gray-300',
                    'placeholder' => 'S',
                ],
                'label' => false,
            ])
            ->add('utilisateur', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'email',
                'required' => false,
                'placeholder' => 'Choisissez un utilisateur (optionnel)',
            ])
            ->add('Enregistrer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
