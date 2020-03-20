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
                        'accept'        => ".png, .jpg, .jpeg",
                    ],
                ]
            )
            ->add(
                'street',
                TextType::class,
                [
                    'label'  => 'Street',
                    'mapped' => false,
                    'attr'   => [
                        'data-required' => 'true',
                    ],
                ]
            )
            ->add(
                'country',
                TextType::class,
                [
                    'label'  => 'Country',
                    'mapped' => false,
                    'attr'   => [
                        'data-required' => 'true',
                    ],
                ]
            )
            ->add(
                'buildingNumber',
                TextType::class,
                [
                    'label'  => 'Building Number',
                    'mapped' => false,
                    'attr'   => [
                        'data-required' => 'true',
                    ],
                ]
            )
            ->add(
                'city',
                TextType::class,
                [
                    'label'  => 'City',
                    'mapped' => false,
                    'attr'   => [
                        'data-required' => 'true',
                    ],
                ]
            )
            ->add(
                'number',
                TextType::class,
                [
                    'label'  => 'Number',
                    'mapped' => false,
                    'attr'   => [
                        'data-required' => 'true',
                        'maxlength'     => '20',
                    ],
                ]
            )
            ->add(
                'countryCode',
                HiddenType::class,
                [
                    'mapped' => false,
                    'attr'   => [
                        'maxlength' => '10',
                    ],
                ]
            )
            ->getForm();
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
