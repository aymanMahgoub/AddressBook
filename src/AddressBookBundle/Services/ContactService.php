<?php

namespace AddressBookBundle\Services;

use AddressBookBundle\Entity\Contact;
use AddressBookBundle\Repository\ContactRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\OptimisticLockException;
use InvalidArgumentException;
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
     * @param Contact       $contact
     * @param FormInterface $form
     *
     * @throws NonUniqueResultException
     * @throws OptimisticLockException
     */
    public function saveContact(Contact $contact, FormInterface $form)
    {
        $address      = $this->addressService->getContactAddress($contact ,$form);
        $phoneNumbers = $this->phoneService->getContactPhones($contact, $form);
        $contact->setAddress($address);
        $contact->setPhones($phoneNumbers);
        $this->contactRepository->saveContact($contact);
    }

    /**
     * @param int $contactId
     *
     * @return int
     * @throws OptimisticLockException
     */
    public function deleteContact(int $contactId)
    {
        if ($contactId === -1)
        {
            return -1;
        }
        /** @var Contact $contact */
        $contact = $this->contactRepository->find($contactId);
        if (!$contact) {
            throw new InvalidArgumentException('there is no contact with this id: '.$contactId.'in system');
        }
        $contactAddress     = $contact->getAddress();
        $allAddressContacts = $this->contactRepository->findBy(['address' => $contactAddress]);
        if (count($allAddressContacts) == 1) {
            $this->addressService->deleteAddress($contactAddress);
        }
        $this->contactRepository->delete($contact);
    }

}
