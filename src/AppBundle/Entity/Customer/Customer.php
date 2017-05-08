<?php

namespace AppBundle\Entity\Customer;

use AppBundle\Entity\Animal\AbstractAnimal;
use AppBundle\Entity\Animal\Cat;
use AppBundle\Entity\Animal\Dog;
use AppBundle\Entity\CustomerCard\CustomerCard;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
	 * @ORM\Column(name="id", type="integer", nullable=false)
	 *
	 * @var int
	 */
	private $id;

	/**
	 * @ORM\OneToMany(targetEntity="AppBundle\Entity\Customer\Owner", mappedBy="customer", cascade={"persist"})
	 *
	 * @var Owner[]
	 */
	private $owners;

	/**
	 * @ORM\OneToOne(targetEntity="AppBundle\Entity\Customer\Owner", cascade={"persist"})
	 * @ORM\JoinColumn(name="main_owner_id", referencedColumnName="id")
	 *
	 * @var Owner
	 */
	private $mainOwner;

	/**
	 * @ORM\OneToMany(targetEntity="AppBundle\Entity\Animal\AbstractAnimal", mappedBy="customer", cascade={"persist"})
	 *
	 * @var AbstractAnimal[]
	 */
	private $animals;

	/**
	 * @ORM\OneToOne(targetEntity="AppBundle\Entity\Animal\AbstractAnimal", cascade={"persist"})
	 * @ORM\JoinColumn(name="main_animal_id", referencedColumnName="id")
	 *
	 * @var AbstractAnimal
	 */
	private $mainAnimal;

	/**
	 * @ORM\Column(name="status", type="string", length=255, nullable=true)
	 *
	 * @Assert\Type(type="string")
	 *
	 * @var string
	 */
	private $status;

	/**
	 * @ORM\Column(name="address", type="text", nullable=true)
	 *
	 * @Assert\Type(type="string")
	 *
	 * @var string
	 */
	private $address;

	/**
	 * @ORM\Column(name="zip_code", type="string", length=5, nullable=true)
	 *
	 * @Assert\Regex("~\d{5}~")
	 *
	 * @var string
	 */
	private $zipCode;

	/**
	 * @ORM\Column(name="city", type="string", length=255, nullable=true)
	 *
	 * @Assert\Type(type="string")
	 *
	 * @var string
	 */
	private $city;

	/**
	 * @ORM\OneToOne(targetEntity="AppBundle\Entity\CustomerCard\CustomerCard", inversedBy="customer", cascade={"persist"})
	 */
	private $customerCard;

	/**
	 * @var Cat[]
	 */
	private $cats;

	/**
	 * @var Dog[]
	 */
	private $dogs;

	/**
	 * Customer constructor.
	 */
	public function __construct()
	{
		$this->owners = new ArrayCollection();
		$this->animals = new ArrayCollection();
		$this->setCatsAndDogs();
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
		$this->owners->removeElement($owner);

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
	 * Set array collections for cats and dogs
	 */
	private function setCatsAndDogs()
	{
		$this->cats = new ArrayCollection();
		$this->dogs = new ArrayCollection();

		foreach ($this->animals as $animal) {
			if ($animal instanceof Cat) {
				$this->cats->add($animal);
			} elseif ($animal instanceof Dog) {
				$this->dogs->add($animal);
			}
		}
	}

	/**
	 * @return AbstractAnimal[]
	 */
	public function getAnimals()
	{
		return $this->animals;
	}

	/**
	 * @param AbstractAnimal[] $animals
	 *
	 * @return Customer
	 */
	public function setAnimals(ArrayCollection $animals)
	{
		$this->animals = $animals;
		$this->setCatsAndDogs();

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
		$this->setCatsAndDogs();

		return $this;
	}

	/**
	 * @param AbstractAnimal $animal
	 *
	 * @return Customer
	 */
	public function removeAnimal(AbstractAnimal $animal)
	{
		$this->animals->removeElement($animal);
		$this->setCatsAndDogs();

		return $this;
	}

	/**
	 * @return Cat[]
	 */
	public function getCats()
	{
		return $this->cats;
	}

	/**
	 * @param Cat[] $cats
	 */
	public function setCats(ArrayCollection $cats)
	{
		foreach($this->cats as $cat) {
			$this->animals->removeElement($cat);
		}

		foreach ($cats as $cat) {
			$this->animals->add($cat);
		}

		$this->cats = $cats;
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
	 * @return Dog[]
	 */
	public function getDogs()
	{
		return $this->dogs;
	}

	/**
	 * @param Dog[] $dogs
	 */
	public function setDogs($dogs)
	{
		foreach($this->dogs as $dog) {
			$this->animals->removeElement($dog);
		}

		foreach ($dogs as $dog) {
			$this->animals->add($dog);
		}

		$this->dogs = $dogs;
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