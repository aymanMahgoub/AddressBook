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

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getStreet(): string
    {
        return $this->street;
    }

    /**
     * @param string $street
     */
    public function setStreet(string $street)
    {
        $this->street = $street;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @param string $country
     */
    public function setCountry(string $country)
    {
        $this->country = $country;
    }

    /**
     * @return string
     */
    public function getBuildingNumber(): string
    {
        return $this->buildingNumber;
    }

    /**
     * @param string $buildingNumber
     */
    public function setBuildingNumber(string $buildingNumber)
    {
        $this->buildingNumber = $buildingNumber;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city)
    {
        $this->city = $city;
    }

}
