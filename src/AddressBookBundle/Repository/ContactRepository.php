<?php

namespace AddressBookBundle\Repository;

use AddressBookBundle\Entity\Contact;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\OptimisticLockException;

class ContactRepository extends EntityRepository
{
    /**
     * @param Contact $contact
     *
     * @throws OptimisticLockException
     */
    public function saveContact(Contact $contact)
    {
        $this->_em->persist($contact);
        $this->_em->flush();
    }

    /**
     * @param Contact $contact
     *
     * @throws OptimisticLockException
     */
    public function delete(Contact $contact)
    {
        $this->_em->remove($contact);
        $this->_em->flush();

    }

}
