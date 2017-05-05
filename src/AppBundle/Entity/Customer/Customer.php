<?php

namespace AppBundle\Entity\Customer;

use AppBundle\Entity\Animal\AbstractAnimal;
use AppBundle\Entity\Animal\Cat;
use AppBundle\Entity\Animal\Dog;
use AppBundle\Entity\CustomerCard\CustomerCard;
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
	 * @ORM\Column(name="status", type="string", length=255, nullable=true)
	 */
	private $status;

	/**
	 * @ORM\Column(name="address", type="string", length=255, nullable=true)
	 */
	private $address;

	/**
	 * @ORM\Column(name="zip_code", type="string", length=5, nullable=true)
	 */
	private $zipCode;

	/**
	 * @ORM\Column(name="city", type="string", length=255, nullable=true)
	 */
	private $city;

	/**
	 * @ORM\OneToOne(targetEntity="AppBundle\Entity\CustomerCard\CustomerCard", inversedBy="customer")
	 */
	private $customerCard;

	public function __construct()
	{
		$this->owners  = new ArrayCollection();
		$this->animals = new ArrayCollection();
	}

	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param int $id
	 *
	 * @return Customer
	 */
	public function setId($id)
	{
		$this->id = $id;

		return $this;
	}

	/**
	 * @return ArrayCollection
	 */
	public function getOwners()
	{
		return $this->owners;
	}

	/**
	 * @param ArrayCollection $owners
	 *
	 * @return Customer
	 */
	public function setOwners($owners)
	{
		$this->owners = $owners;

		return $this;
	}

	/**
	 * @param Owner $owner
	 *
	 * @return Customer
	 */
	public function addOwner(Owner $owner)
	{
		$this->owners->add($owner);

		return $this;
	}

	/**
	 * @param Owner $owner
	 *
	 * @return Customer
	 */
	public function removeOwner(Owner $owner)
	{
		$this->owners->remove($owner);

		return $this;
	}

	/**
	 * @return Owner
	 */
	public function getMainOwner()
	{
		return $this->mainOwner;
	}

	/**
	 * @param Owner $mainOwner
	 *
	 * @return Customer
	 */
	public function setMainOwner(Owner $mainOwner)
	{
		$this->mainOwner = $mainOwner;

		return $this;
	}

	/**
	 * @return ArrayCollection
	 */
	public function getAnimals()
	{
		return $this->animals;
	}

	/**
	 * @param ArrayCollection $animals
	 *
	 * @return Customer
	 */
	public function setAnimals($animals)
	{
		$this->animals = $animals;

		return $this;
	}

	/**
	 * @param AbstractAnimal $animal
	 *
	 * @return Customer
	 */
	public function addAnimal(AbstractAnimal $animal)
	{
		$this->animals->add($animal);

		return $this;
	}

	/**
	 * @param AbstractAnimal $animal
	 *
	 * @return Customer
	 */
	public function removeAnimal(AbstractAnimal $animal)
	{
		$this->animals->remove($animal);

		return $this;
	}

	/**
	 * @param Cat $cat
	 *
	 * @return Customer
	 */
	public function addCat(Cat $cat)
	{
		$this->addAnimal($cat);

		return $this;
	}

	/**
	 * @param Cat $cat
	 *
	 * @return Customer
	 */
	public function removeCat(Cat $cat)
	{
		$this->removeAnimal($cat);

		return $this;
	}

	/**
	 * @param Dog $dog
	 *
	 * @return Customer
	 */
	public function addDog(Dog $dog)
	{
		$this->addAnimal($dog);

		return $this;
	}

	/**
	 * @param Dog $dog
	 *
	 * @return Customer
	 */
	public function removeDog(Dog $dog)
	{
		$this->removeAnimal($dog);

		return $this;
	}

	/**
	 * @return AbstractAnimal
	 */
	public function getMainAnimal()
	{
		return $this->mainAnimal;
	}

	/**
	 * @param AbstractAnimal $mainAnimal
	 *
	 * @return Customer
	 */
	public function setMainAnimal(AbstractAnimal $mainAnimal)
	{
		$this->mainAnimal = $mainAnimal;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getStatus()
	{
		return $this->status;
	}

	/**
	 * @param string $status
	 *
	 * @return Customer
	 */
	public function setStatus($status)
	{
		$this->status = $status;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getAddress()
	{
		return $this->address;
	}

	/**
	 * @param string $address
	 *
	 * @return Customer
	 */
	public function setAddress($address)
	{
		$this->address = $address;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getZipCode()
	{
		return $this->zipCode;
	}

	/**
	 * @param string $zipCode
	 *
	 * @return Customer
	 */
	public function setZipCode($zipCode)
	{
		$this->zipCode = $zipCode;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getCity()
	{
		return $this->city;
	}

	/**
	 * @param string $city
	 *
	 * @return Customer
	 */
	public function setCity($city)
	{
		$this->city = $city;

		return $this;
	}

	/**
	 * @return CustomerCard
	 */
	public function getCustomerCard()
	{
		return $this->customerCard;
	}

	/**
	 * @param CustomerCard $customerCard
	 *
	 * @return Customer
	 */
	public function setCustomerCard(CustomerCard $customerCard)
	{
		$this->customerCard = $customerCard;

		return $this;
	}

	public function __toString()
	{
		return sprintf(
			'%s - %s',
			$this->getMainAnimal()->getName(),
			$this->getMainOwner()->getLastName()
		);
	}
}