<?php

namespace AppBundle\Entity\Customer;

use AppBundle\Entity\Animal\AbstractAnimal;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Customer
 * @package AppBundle\Entity\Customer
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Customer\CustomerRepository")
 * @ORM\Table(name="customer")
 */
class Customer
{
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\Column(name="id", type="integer")
	 */
	private $id;

	/**
	 * @ORM\OneToMany(targetEntity="AppBundle\Entity\Customer\Owner", mappedBy="customer")
	 */
	private $owners;

	/**
	 * @ORM\OneToOne(targetEntity="AppBundle\Entity\Customer\Owner")
	 * @ORM\JoinColumn(name="main_owner_id", referencedColumnName="id")
	 */
	private $mainOwner;

	/**
	 * @ORM\OneToMany(targetEntity="AppBundle\Entity\Animal\AbstractAnimal", mappedBy="customer")
	 */
	private $animals;

	/**
	 * @ORM\OneToOne(targetEntity="AppBundle\Entity\Animal\AbstractAnimal")
	 * @ORM\JoinColumn(name="main_animal_id", referencedColumnName="id")
	 */
	private $mainAnimal;

	/**
	 * @ORM\Column(name="status", type="string", length=255)
	 */
	private $status;

	/**
	 * @ORM\Column(name="address", type="string", length=255)
	 */
	private $address;

	/**
	 * @ORM\Column(name="zip_code", type="string", length=5)
	 */
	private $zipCode;

	/**
	 * @ORM\Column(name="city", type="string", length=255)
	 */
	private $city;

	/**
	 * @ORM\Column(name="phone", type="string", length=10)
	 */
	private $phone;

	/**
	 * @ORM\Column(name="email", type="string", length=255)
	 */
	private $email;

	/**
	 * @ORM\OneToOne(targetEntity="AppBundle\Entity\CustomerCard", inversedBy="customer")
	 */
	private $customerCard;

	public function __construct()
	{
		$this->owners  = new ArrayCollection();
		$this->animals = new ArrayCollection();
	}

	/**
	 * @return mixed
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param mixed $id
	 *
	 * @return Customer
	 */
	public function setId($id)
	{
		$this->id = $id;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getOwners()
	{
		return $this->owners;
	}

	/**
	 * @param mixed $owners
	 *
	 * @return Customer
	 */
	public function setOwners($owners)
	{
		$this->owners = $owners;

		return $this;
	}

	public function addOwner(Owner $owner)
	{
		$this->owners->add($owner);

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getMainOwner()
	{
		return $this->mainOwner;
	}

	/**
	 * @param mixed $mainOwner
	 *
	 * @return Customer
	 */
	public function setMainOwner(Owner $mainOwner)
	{
		$this->mainOwner = $mainOwner;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getAnimals()
	{
		return $this->animals;
	}

	/**
	 * @param mixed $animals
	 *
	 * @return Customer
	 */
	public function setAnimals($animals)
	{
		$this->animals = $animals;

		return $this;
	}

	public function addAnimal(AbstractAnimal $animal)
	{
		$this->animals->add($animal);

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getMainAnimal()
	{
		return $this->mainAnimal;
	}

	/**
	 * @param mixed $mainAnimal
	 *
	 * @return Customer
	 */
	public function setMainAnimal(AbstractAnimal $mainAnimal)
	{
		$this->mainAnimal = $mainAnimal;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getStatus()
	{
		return $this->status;
	}

	/**
	 * @param mixed $status
	 *
	 * @return Customer
	 */
	public function setStatus($status)
	{
		$this->status = $status;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getAddress()
	{
		return $this->address;
	}

	/**
	 * @param mixed $address
	 *
	 * @return Customer
	 */
	public function setAddress($address)
	{
		$this->address = $address;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getZipCode()
	{
		return $this->zipCode;
	}

	/**
	 * @param mixed $zipCode
	 *
	 * @return Customer
	 */
	public function setZipCode($zipCode)
	{
		$this->zipCode = $zipCode;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getCity()
	{
		return $this->city;
	}

	/**
	 * @param mixed $city
	 *
	 * @return Customer
	 */
	public function setCity($city)
	{
		$this->city = $city;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getPhone()
	{
		return $this->phone;
	}

	/**
	 * @param mixed $phone
	 *
	 * @return Customer
	 */
	public function setPhone($phone)
	{
		$this->phone = $phone;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getEmail()
	{
		return $this->email;
	}

	/**
	 * @param mixed $email
	 *
	 * @return Customer
	 */
	public function setEmail($email)
	{
		$this->email = $email;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getCustomerCard()
	{
		return $this->customerCard;
	}

	/**
	 * @param mixed $customerCard
	 *
	 * @return Customer
	 */
	public function setCustomerCard($customerCard)
	{
		$this->customerCard = $customerCard;

		return $this;
	}
}