<?php

namespace AddressBookBundle\Repository;

use AddressBookBundle\Entity\Phone;
use Doctrine\ORM\EntityRepository;

class PhoneRepository extends EntityRepository
{
    /**
     * @param Phone[] $phones
     */
    public function persistPhoneNumbers(array $phones)
    {
        foreach ($phones as $phone) {
            $this->_em->persist($phone);
        }
    }

}
