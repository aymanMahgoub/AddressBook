<?php

namespace AddressBookBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
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
            ->add(
                'firstNumber',
                TextType::class,
                [
                    'mapped' => false,
                    'attr'   => [
                        'data-required' => 'true',
                        'maxlength'     => '20',
                    ],
                ]
            )
            ->add(
                'secondNumber',
                TextType::class,
                [
                    'mapped'   => false,
                    'required' => false,
                    'attr'     => [
                        'maxlength' => '20',
                    ],
                ]
            )
            ->add(
                'thirdNumber',
                TextType::class,
                [
                    'mapped'   => false,
                    'required' => false,
                    'attr'     => [
                        'maxlength' => '20',
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
