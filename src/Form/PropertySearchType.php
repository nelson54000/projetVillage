<?php

namespace App\Form;

use App\Entity\PropertySearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PropertySearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('minSurface', IntegerType::class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'surface minimale'
                ]
            ])

            ->add('maxPrice', IntegerType::class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Budget maximale'
                ]
            ]);
    }

    //https://www.youtube.com/watch?v=fRJJKxwQDf0&list=PLjwdMgw5TTLX7wmorGgfrqI9TcA8nMb29&index=8
    //7:40
public function getBlockPrefix()
{
return'';
}


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PropertySearch::class,
             'method'=>'get',
             'csrf_protection'=> false
        ]);
    }
}
