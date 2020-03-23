<?php

namespace AddressBookBundle\Services;

use AddressBookBundle\Entity\Address;
use AddressBookBundle\Repository\AddressRepository;
use Doctrine\ORM\NonUniqueResultException;
use InvalidArgumentException;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class AddressService
 *
 * @package AddressBookBundle\Services
 */
class AddressService
{
    /** @var AddressRepository $addressRepository */
    protected $addressRepository;

    /** @var ValidatorInterface $validator */
    protected $validator;

    /**
     * AddressService constructor.
     *
     * @param AddressRepository  $addressRepository
     * @param ValidatorInterface $validator
     */
    public function __construct(
        AddressRepository $addressRepository,
        ValidatorInterface $validator
    ) {
        $this->addressRepository = $addressRepository;
        $this->validator         = $validator;
    }

    /**
     * @param FormInterface $form
     *
     * @return Address
     * @throws NonUniqueResultException
     */
    public function getContactAddress(FormInterface $form)
    {
        /** @var Address $address */
        $address        = $this->hydrateAddress($form);
        $address = $this->addressRepository->findAddress($address) ?? $address;

        return $address;
    }

    /**
     * @param FormInterface $form
     *
     * @return Address
     */
    private function hydrateAddress(FormInterface $form)
    {
        $address = new Address();
        $address->setCity($form['city']->getData());
        $address->setCountry($form['country']->getData());
        $address->setStreet($form['street']->getData());
        $address->setBuildingNumber($form['buildingNumber']->getData());

        $this->isValidAddress($address);

        return $address;
    }

    /**
     * @param Address $address
     * @throws InvalidArgumentException
     */
    private function isValidAddress(Address $address)
    {
        $addrssErrors = $this->validator->validate($address);
        $errors       = [];
        if ($addrssErrors->count() > 0) {
            /** @var ConstraintViolationInterface $addrssError */
            foreach ($addrssErrors as $addrssError) {
                $errors[] = [
                    "errorMessage"      => $addrssError->getMessage(),
                    "errorPropertyPath" => $addrssError->getPropertyPath(),
                ];
            }

            throw new InvalidArgumentException('Invalid Address: '.json_decode($errors));
        }
    }

}
