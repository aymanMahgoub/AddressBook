<?php

namespace AddressBookBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Address
 *
 * @ORM\Entity()
 * @ORM\Table(name="contact")
 */
class Address
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="street", type="string", length=100, nullable=false)
     * @Assert\NotNull(message="Street can't be left empty")
     *
     */
    protected $street;

    /**
     * @var string
     *
     * @ORM\Column(name="country",type="string",length=50, nullable=false)
     * @Assert\NotNull(message="Country can't be left empty")
     */
    protected $country;

    /**
     * @var string
     *
     * @ORM\Column(name="building_number", type="string", length=3, nullable=false)
     * @Assert\NotNull(message="Building number can't be left empty")
     *
     */
    protected $buildingNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255, nullable=false)
     * @Assert\NotNull(message="City must be selected")
     *
     */
    protected $city;

}
