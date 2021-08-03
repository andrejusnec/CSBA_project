<?php

namespace App\Form;

use App\Entity\Country;
use App\Entity\Order;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Security;

class OrderType extends AbstractType
{
    private Security $security;
    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->setAttribute('attr','class="row"')
            ->add('address', TextType::class, [
                'attr' => ['class' => 'form-control'],
            ])
            ->add('city', TextType::class, [
                'attr' => ['class' => 'form-control'],
            ])
            ->add('post_code',NumberType::class, [
                'attr' => ['class' => 'form-control'],
            ])->add('country', EntityType::class, [
                'class' => Country::class,
                'choice_label' => 'title',
                'attr' => ['class' => 'form-control']
            ])->add('first_name', TextType::class, [
                'attr' => ['class' => 'form-control', 'value' => $this->security->getUser()->getFirstName(),
                    'placeholder' => 'Your name'],
                'mapped' => false
            ])->add('last_name', TextType::class, [
                'attr' => ['class' => 'form-control', 'value' => $this->security->getUser()->getLastName(),
                    'placeholder' => 'Your surname'],
                'mapped' => false
            ])->add('email', TextType::class, [
                'attr' => ['class' => 'form-control', 'value' => $this->security->getUser()->getEmail(),
                    'placeholder' => 'Email address'],
                'mapped' => false
            ])->add('phone', TextType::class, [
                'attr' => ['class' => 'form-control', 'value' => $this->security->getUser()->getPhone(),
                    'placeholder' => 'Phone number'],
                'mapped' => false
            ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
        ]);
    }
}
