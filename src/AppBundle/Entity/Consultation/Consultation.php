<?php

namespace AppBundle\Entity\Consultation;

use AppBundle\Entity\Animal\AbstractAnimal;
use AppBundle\Entity\Customer\Owner;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Consultation
 * @package AppBundle\Entity
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Consultation\ConsultationRepository")
 * @ORM\Table(name="consultation")
 */
class Consultation
{
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\Column(name="id", type="integer")
	 */
	private $id;

	/**
	 * @ORM\Column(name="price", type="float")
	 */
	private $price;

	/**
	 * @ORM\Column(name="date", type="datetime")
	 */
	private $date;

	/**
	 * @ORM\Column(name="duration", type="integer")
	 */
	private $duration;

	/**
	 * @ORM\Column(name="location", type="string", length=255)
	 */
	private $location;

	/**
	 * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Animal\AbstractAnimal")
	 * @ORM\JoinTable(name="l__consultation_animals",
	 *	 joinColumns={@ORM\JoinColumn(name="consultation_id", referencedColumnName="id")},
	 *	 inverseJoinColumns={@ORM\JoinColumn(name="animal_id", referencedColumnName="id")}
	 * )
	 */
	private $animals;

	/**
	 * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Customer\Owner")
	 * @ORM\JoinTable(name="l__consultation_owners",
	 *	 joinColumns={@ORM\JoinColumn(name="consultation_id", referencedColumnName="id")},
	 *	 inverseJoinColumns={@ORM\JoinColumn(name="owner_id", referencedColumnName="id")}
	 * )
	 */
	private $owners;

	/**
	 * @ORM\ManyToOne(targetEntity="AppBundle\Entity\CustomerCard")
	 * @ORM\JoinColumn(name="customer_card_id", referencedColumnName="id")
	 */
	private $customerCard;

	public function __construct()
	{
		$this->animals = new ArrayCollection();
		$this->owners  = new ArrayCollection();
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
	 * @return Consultation
	 */
	public function setId($id)
	{
		$this->id = $id;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getPrice()
	{
		return $this->price;
	}

	/**
	 * @param mixed $price
	 *
	 * @return Consultation
	 */
	public function setPrice($price)
	{
		$this->price = $price;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getDate()
	{
		return $this->date;
	}

	/**
	 * @param mixed $date
	 *
	 * @return Consultation
	 */
	public function setDate($date)
	{
		$this->date = $date;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getDuration()
	{
		return $this->duration;
	}

	/**
	 * @param mixed $duration
	 *
	 * @return Consultation
	 */
	public function setDuration($duration)
	{
		$this->duration = $duration;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getLocation()
	{
		return $this->location;
	}

	/**
	 * @param mixed $location
	 *
	 * @return Consultation
	 */
	public function setLocation($location)
	{
		$this->location = $location;

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
	 * @return Consultation
	 */
	public function setAnimals($animals)
	{
		$this->animals = $animals;

		return $this;
	}

	/**
	 * @param AbstractAnimal $animal
	 *
	 * @return $this
	 */
	public function addAnimal(AbstractAnimal $animal)
	{
		$this->animals->add($animal);

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
	 * @return Consultation
	 */
	public function setOwners($owners)
	{
		$this->owners = $owners;

		return $this;
	}

	/**
	 * @param Owner $owner
	 *
	 * @return $this
	 */
	public function addOwner(Owner $owner)
	{
		$this->owners->add($owner);

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
	 * @return Consultation
	 */
	public function setCustomerCard($customerCard)
	{
		$this->customerCard = $customerCard;

		return $this;
	}
}