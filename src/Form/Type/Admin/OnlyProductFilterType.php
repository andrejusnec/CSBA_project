<?php

namespace App\Form\Type\Admin;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OnlyProductFilterType extends AbstractType
{
//    public function configureOptions(OptionsResolver $resolver)
//    {
//        $resolver->setDefaults([
//            'choices' => [
//                'Today' => 'today',
//                'This month' => 'this_month',
//                // ...
//            ],
//        ]);
//    }

    public function getParent()
    {
        return EntityType::class;
    }

}

