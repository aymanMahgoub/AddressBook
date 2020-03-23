<?php

namespace AddressBookBundle\Services;

use AddressBookBundle\Entity\Contact;
use AddressBookBundle\Repository\ContactRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\OptimisticLockException;
use Symfony\Component\Form\FormInterface;

/**
 * Class ContactService
 *
 * @package AddressBookBundle\Services
 */
class ContactService
{
    /** @var ContactRepository $contactRepository */
    protected $contactRepository;

    /** @var AddressService $addressService */
    protected $addressService;

    /** @var PhoneService $phoneService */
    protected $phoneService;

    /**
     * ContactService constructor.
     *
     * @param ContactRepository $contactRepository
     * @param AddressService    $addressService
     * @param PhoneService      $phoneService
     */
    public function __construct(
        ContactRepository $contactRepository,
        AddressService $addressService,
        PhoneService $phoneService
    ) {
        $this->contactRepository = $contactRepository;
        $this->addressService    = $addressService;
        $this->phoneService      = $phoneService;
    }

    /**
     * @return array
     */
    public function getAllContacts()
    {
        return $this->contactRepository->findAll();
    }

    /**
     * @param Contact       $contact
     * @param FormInterface $form
     *
     * @throws NonUniqueResultException
     * @throws OptimisticLockException
     */
    public function saveContact(Contact $contact, FormInterface $form)
    {
        $address      = $this->addressService->getContactAddress($form);
        $phoneNumbers = $this->phoneService->getContactPhones($contact, $form);
        $contact->setAddress($address);
        $contact->setPhones($phoneNumbers);
        $this->contactRepository->saveContact($contact);
    }

}
