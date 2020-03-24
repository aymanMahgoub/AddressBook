<?php

namespace AddressBookBundle\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Contact
 *
 * @ORM\Entity(repositoryClass="AddressBookBundle\Repository\ContactRepository")
 * @ORM\Table(name="contact")
 */
class Contact
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
     * @ORM\Column(name="first_name", type="string", length=50, nullable=false)
     * @Assert\NotNull(message="First name can't be left empty")
     *
     */
    protected $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=50, nullable=false)
     * @Assert\NotNull(message="Last name can't be left empty")
     *
     */
    protected $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100, nullable=false)
     * @Assert\Email()
     *
     */
    protected $email;

    /**
     * @var DateTime
     * @ORM\Column(name="birthday", type="date", nullable=false )
     * @Assert\Date()
     *
     */
    private $birthday;

    /**
     * @var string
     *
     * @ORM\Column(name="picture", type="string", length=255, nullable=true)
     *
     */
    protected $picture;

    /**
     * @var Address
     * @ORM\ManyToOne(targetEntity="Address")
     * @ORM\JoinColumn(name="address_id", referencedColumnName="id")
     */
    protected $address;

    /**
     * @var Phone[]|ArrayCollection $phones
     * @ORM\OneToMany(targetEntity="Phone", mappedBy="contact", cascade={"remove"})
     * @Assert\Count(max=3 , maxMessage="You can add up to 3 phone only")
     *
     */
    protected $phones;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * @return DateTime
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * @param DateTime $birthday
     */
    public function setBirthday(DateTime $birthday)
    {
        $this->birthday = $birthday;
    }

    /**
     * @return string|null
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * @param string|null $picture
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;
    }

    /**
     * @return Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param Address $address
     */
    public function setAddress(Address $address)
    {
        $this->address = $address;
    }

    /**
     * @return Phone[]|ArrayCollection
     */
    public function getPhones()
    {
        return $this->phones;
    }

    /**
     * @param Phone[]|ArrayCollection $phones
     */
    public function setPhones($phones)
    {
        $this->phones = $phones;
    }

}
