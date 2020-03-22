<?php

namespace AddressBookBundle\Services;

use AddressBookBundle\Entity\Contact;
use AddressBookBundle\Repository\ContactRepository;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ContactService
 *
 * @package AddressBookBundle\Services
 */
class ContactService
{
    /** @var ContactRepository $contactRepository */
    protected $contactRepository;

    public function __construct(ContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    /**
     * @return array
     */
    public function getAllContacts()
    {
        return $this->contactRepository->findAll();
    }

    /**
     * @param Contact $contact
     * @param Request $request
     *
     * @return array
     */
    public function saveContact(Contact $contact, Request $request)
    {
        dump($contact, $request);die;
        return [
            'success' => true,
        ];
    }

}
