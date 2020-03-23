<?php

namespace AddressBookBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
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
                'attr' => [
                    'data-required' => 'true',
                ],
            ]
        )
            ->add(
                'lastName',
                TextType::class,
                [
                    'attr' => [
                        'data-required' => 'true',
                    ],
                ]
            )
            ->add(
                'email',
                EmailType::class,
                [
                    'attr' => [
                        'data-required' => 'true',
                    ],
                ]
            )
            ->add(
                'birthday',
                BirthdayType::class,
                [
                    'attr' => [
                        'data-required' => 'true',
                    ],
                ]
            )
            ->add(
                'picture',
                FileType::class,
                [
                    'required' => false,
                    'attr'     => [
                        'data-required' => 'false',
                        'accept'        => ".png, .jpg, .jpeg",
                    ],
                ]
            )
            ->add(
                'street',
                TextType::class,
                [
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
                    'mapped' => false,
                    'attr'   => [
                        'data-required' => 'true',
                    ],
                ]
            )
            ->add(
                'buildingNumber',
                NumberType::class,
                [
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
                    'mapped' => false,
                    'attr'   => [
                        'data-required' => 'true',
                    ],
                ]
            )
            ->add('phones',CollectionType::class, [
                'allow_add' => true,
                'by_reference' => false,
                'label' => false,
            ])
            ->add('CountryCode_0', HiddenType::class, [
                    'mapped' => false,
                ])
            ->add('CountryCode_1', HiddenType::class, [
                'mapped' => false,
            ])
            ->add('CountryCode_2', HiddenType::class, [
                'mapped' => false,
            ])
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
