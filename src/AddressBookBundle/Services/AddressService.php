<?php

namespace AddressBookBundle\Services;

use AddressBookBundle\Entity\Address;
use AddressBookBundle\Entity\Contact;
use AddressBookBundle\Repository\AddressRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\OptimisticLockException;
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
     * @param Contact       $contact
     * @param FormInterface $form
     *
     * @return Address
     * @throws NonUniqueResultException
     */
    public function getContactAddress(Contact $contact, FormInterface $form)
    {
        /** @var Address $address */
        $address = $this->hydrateAddress($form, $contact->getAddress());
        $contactAddress = $this->addressRepository->findAddress($address);
        if (!empty($contactAddress)) {
            return $contactAddress[0];
        }
        $this->addressRepository->persistAddress($address);

        return $address;
    }

    /**
     * @param FormInterface $form
     * @param Address|null  $address
     *
     * @return Address
     */
    private function hydrateAddress(FormInterface $form, Address $address= null)
    {
        if (!$address) {
            $address = new Address();
        }
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

    /**
     * @param Address $address
     *
     * @throws OptimisticLockException
     */
    public function deleteAddress(Address $address)
    {
        $this->addressRepository->delete($address);
    }

}
