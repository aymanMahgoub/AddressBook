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
        $address = $this->hydrateAddress($form);
        $contactAddress = $this->addressRepository->findAddress($address);
        if (!empty($contactAddress)) {
            return $contactAddress[0];
        }
        $this->addressRepository->persistAddress($address);

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
        $address->setCity($form->get('city')->getData());
        $address->setCountry($form->get('country')->getData());
        $address->setStreet($form->get('street')->getData());
        $address->setBuildingNumber($form->get('buildingNumber')->getData());
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
