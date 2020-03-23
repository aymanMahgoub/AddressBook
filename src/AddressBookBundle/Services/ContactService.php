<?php

namespace AddressBookBundle\Services;

use AddressBookBundle\Entity\Contact;
use AddressBookBundle\Repository\ContactRepository;
use Doctrine\ORM\NonUniqueResultException;
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

    /**
     * ContactService constructor.
     *
     * @param ContactRepository $contactRepository
     * @param AddressService    $addressService
     */
    public function __construct(
        ContactRepository $contactRepository,
        AddressService $addressService
    ) {
        $this->contactRepository = $contactRepository;
        $this->addressService    = $addressService;
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
     * @return array
     * @throws NonUniqueResultException
     * @throws NonUniqueResultException
     */
    public function saveContact(Contact $contact, FormInterface $form)
    {
        $address = $this->addressService->getContactAddress($form);
        $contact->setAddress($address);

        return [
            'success' => true,
        ];
    }

}
