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
        $query        = $queryBuilder->select()
            ->where(
                $queryBuilder->expr()
                    ->eq('address.city', $address->getCity())
            )
            ->andWhere(
                $queryBuilder->expr()
                    ->eq('address.county', $address->getCountry())
            )
            ->andWhere(
                $queryBuilder->expr()
                    ->eq('address.street', $address->getStreet())
            )
            ->andWhere(
                $queryBuilder->expr()
                    ->eq('address.buildingNumber', $address->getBuildingNumber())
            );

        return $query->getQuery()
            ->getOneOrNullResult();
    }

}
