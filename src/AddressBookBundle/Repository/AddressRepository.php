<?php

namespace AddressBookBundle\Repository;

use AddressBookBundle\Entity\Address;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NonUniqueResultException;

class AddressRepository extends EntityRepository
{
    /**
     * @param Address $address
     *
     * @return mixed
     * @throws NonUniqueResultException
     */
    public function findAddress(Address $address)
    {
        $queryBuilder = $this->createQueryBuilder('address');
        $query        = $queryBuilder->select('address')
            ->where(
                $queryBuilder->expr()
                    ->eq('address.city', ':city')
            )
            ->setParameter('city', $address->getCity())
            ->andWhere(
                $queryBuilder->expr()
                    ->eq('address.country', ':country')
            )
            ->setParameter('country', $address->getCountry())
            ->andWhere(
                $queryBuilder->expr()
                    ->eq('address.street', ':street')
            )
            ->setParameter('street', $address->getStreet())
            ->andWhere(
                $queryBuilder->expr()
                    ->eq('address.buildingNumber', ':buildingNumber')
            )
            ->setParameter('buildingNumber', $address->getBuildingNumber())
            ->setMaxResults(1)
        ;

        return $query->getQuery()->getResult();
    }

    /**
     * @param Address $address
     */
    public function persistAddress(Address $address)
    {
        $this->_em->persist($address);
    }

}
