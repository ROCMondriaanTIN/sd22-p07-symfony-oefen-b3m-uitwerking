<?php

namespace App\Form;

use App\Entity\Order;
use App\Entity\Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', null, ['label' => 'Wat is je voornaam?'])
            ->add('lastname', null, ['label' => 'Wat is je achternaam?'])
            ->add('address', null, ['label' => 'Wat is je address?'])
            ->add('size', ChoiceType::class, ['label' => 'Kies je maar',
                'choices' => [
                    'Groot + 4 Euro' => 'large',
                    'Middel + 2 Euro' => 'medium',
                    'Normaal' => 'regular',
                    'Klein - 1 Euro' => 'small',
                ],
                'data' => 'regular',
                'attr'  => ['class' => 'pizza-select'],
            ])
            ->add('submit', SubmitType::class, ['label' => 'Bestel deze pizza'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
        ]);
    }
}
