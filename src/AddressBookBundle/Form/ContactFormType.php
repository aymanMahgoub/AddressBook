<?php

namespace AddressBookBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'firstName',
            TextType::class,
            [
                'label' => 'First Name',
                'attr'  => [
                    'data-required' => 'true',
                ],
            ]
        )
            ->add(
                'lastName',
                TextType::class,
                [
                    'label' => 'Last Name',
                    'attr'  => [
                        'data-required' => 'true',
                    ],
                ]
            )
            ->add(
                'email',
                EmailType::class,
                [
                    'label' => 'Email',
                    'attr'  => [
                        'data-required' => 'true',
                    ],
                ]
            )
            ->add(
                'birthday',
                DateType::class,
                [
                    'label' => 'Birthday',
                    'attr'  => [
                        'data-required' => 'true',
                    ],
                ]
            )
            ->add(
                'picture',
                FileType::class,
                [
                    'label' => 'Picture',
                    'attr'  => [
                        'data-required' => 'false',
                    ],
                ]
            )
            ->add(
                'street',
                FileType::class,
                [
                    'label' => 'Street',
                    'attr'  => [
                        'data-required' => 'true',
                    ],
                ]
            )
            ->add(
                'country',
                FileType::class,
                [
                    'label' => 'Country',
                    'attr'  => [
                        'data-required' => 'true',
                    ],
                ]
            )
            ->add(
                'buildingNumber',
                FileType::class,
                [
                    'label' => 'Building Number',
                    'attr'  => [
                        'data-required' => 'true',
                    ],
                ]
            )
            ->add(
                'city',
                FileType::class,
                [
                    'label' => 'City',
                    'attr'  => [
                        'data-required' => 'true',
                    ],
                ]
            )
            ->add(
                'number',
                FileType::class,
                [
                    'label' => 'Number',
                    'attr'  => [
                        'data-required' => 'true',
                        'maxlength'     => '20',
                    ],
                ]
            )
            ->add(
                'countryCode',
                HiddenType::class,
                [
                    'mapped' => true,
                    'attr'  => [
                        'maxlength' => '10',
                    ],
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => 'AddressBookBundle\Entity\Contact',
            ]
        );
    }

}
