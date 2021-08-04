<?php

namespace App\Form;

use App\Entity\ProductOrderList;
use App\Entity\ProductsAndServices;
use App\Repository\ProductsAndServicesRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductOrderListType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('quantity', NumberType::class)
            ->add('price', NumberType::class)
            //->add('total', NumberType::class)
            ->add('product', EntityType::class, [
            'class' => ProductsAndServices::class,
            'query_builder' => function (ProductsAndServicesRepository $repo) {
                return $repo->createQueryBuilder('prod')
                    ->andWhere('prod.isActive = :val')
                    ->andWhere('prod.isProduct = :val')
                    ->setParameter('val', true);
            },
            'choice_label' => 'title',
        ])->add('total', NumberType::class);
//        $builder->addEventListener(
//                FormEvents::PRE_SUBMIT,
//                function (FormEvent $event) {
//                    $form = $event->getForm();
//                    $data = $event->getData();
//                    $pricea = $data->getPrice();
//                    $quantitya = $data->getQuantity();
//                    $total = $pricea * $quantitya;
////                    $data['total'] = strval($total);
////                    $form->setData($data);
//                    $form->add('total', NumberType::class, [
//                        'disabled' => 'disabled',
//                        'data' => $total,
//                    ]);
//                }
//            );



    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ProductOrderList::class,
        ]);
    }
}
