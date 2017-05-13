<?php

namespace AppBundle\Entity\CustomerCard;

use AppBundle\Entity\Animal\AbstractAnimal;
use AppBundle\Entity\Customer\Owner;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class CustomerCard
 * @package AppBundle\Entity
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CustomerCard\ConsultationRepository")
 * @ORM\Table(name="consultation")
 */
class Consultation
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
	 * @ORM\Column(name="price", type="float", nullable=true)
	 *
	 * @Assert\Type(type="float")
	 *
	 * @var float
	 */
	private $price;
	
	/**
	 * @ORM\Column(name="date", type="datetime", nullable=false)
	 *
	 * @Assert\Date()
	 *
	 * @var DateTime
	 */
	private $date;
	
	/**
	 * @ORM\Column(name="duration", type="time", nullable=true)
	 *
	 * @Assert\Time()
	 *
	 * @var DateTime
	 */
	private $duration;
	
	/**
	 * @ORM\Column(name="location", type="string", length=255, nullable=true)
	 *
	 * @Assert\Type(type="string")
	 *
	 * @var string
	 */
	private $location;
	
	/**
	 * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Animal\AbstractAnimal", fetch="EAGER",)
	 * @ORM\JoinTable(name="l__consultation_animals",
	 *     joinColumns={@ORM\JoinColumn(name="consultation_id", referencedColumnName="id")},
	 *     inverseJoinColumns={@ORM\JoinColumn(name="animal_id", referencedColumnName="id")}
	 * )
	 *
	 * @var AbstractAnimal[]
	 */
	private $animals;
	
	/**
	 * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Customer\Owner", fetch="EAGER")
	 * @ORM\JoinTable(name="l__consultation_owners",
	 *     joinColumns={@ORM\JoinColumn(name="consultation_id", referencedColumnName="id")},
	 *     inverseJoinColumns={@ORM\JoinColumn(name="owner_id", referencedColumnName="id")}
	 * )
	 *
	 * @var Owner[]
	 */
	private $owners;
	
	/**
	 * @ORM\ManyToOne(
	 *     targetEntity="AppBundle\Entity\CustomerCard\CustomerCard",
	 *     inversedBy="consultations",
	 *     fetch="EAGER",
	 *     cascade={"persist"}
	 *     )
	 * @ORM\JoinColumn(name="customer_card_id", referencedColumnName="id", nullable=false)
	 *
	 * @var CustomerCard
	 */
	private $customerCard;
	
	/**
	 * @ORM\Column(name="type", type="string", length=12, nullable=false)
	 *
	 * @Assert\Choice(choices={"educator", "behaviourist"}, message="Choose a valid type")
	 *
	 * @var string
	 */
	private $type;
	
	/**
	 * @ORM\Column(name="purposes", type="text", nullable=true)
	 *
	 * @Assert\Type(type="string")
	 *
	 * @var string
	 */
	private $purposes;
	
	public static $types = [
		'educator'     => 'entity.consultation.type.educator',
		'behaviourist' => 'entity.consultation.type.behaviourist',
	];
	
	public function __construct()
	{
		$this->animals = new ArrayCollection();
		$this->owners  = new ArrayCollection();
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
	 * @return Consultation
	 */
	public function setId($id)
	{
		$this->id = $id;
		
		return $this;
	}
	
	/**
	 * @return float
	 */
	public function getPrice()
	{
		return $this->price;
	}
	
	/**
	 * @param float $price
	 *
	 * @return Consultation
	 */
	public function setPrice($price)
	{
		$this->price = $price;
		
		return $this;
	}
	
	/**
	 * @return \DateTime
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
	public function setDate(\DateTime $date)
	{
		$this->date = $date;
		
		return $this;
	}
	
	/**
	 * @return DateTime
	 */
	public function getDuration()
	{
		return $this->duration;
	}
	
	/**
	 * @param DateTime $duration
	 *
	 * @return Consultation
	 */
	public function setDuration(DateTime $duration = null)
	{
		$this->duration = $duration;
		
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getLocation()
	{
		return $this->location;
	}
	
	/**
	 * @param string $location
	 *
	 * @return Consultation
	 */
	public function setLocation($location)
	{
		$this->location = $location;
		
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
	 * @param AbstractAnimal $animal
	 *
	 * @return $this
	 */
	public function removeAnimal(AbstractAnimal $animal)
	{
		$this->animals->removeElement($animal);
		
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
	 * @param Owner $owner
	 *
	 * @return $this
	 */
	public function removeOwner(Owner $owner)
	{
		$this->owners->removeElement($owner);
		
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
	 * @return Consultation
	 */
	public function setCustomerCard(CustomerCard $customerCard)
	{
		$this->customerCard = $customerCard;
		
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getType()
	{
		return $this->type;
	}
	
	/**
	 * @param string $type
	 *
	 * @return Consultation
	 */
	public function setType($type)
	{
		if (!is_string($type) || !array_key_exists($type, static::$types)) {
			throw new \InvalidArgumentException(
				sprintf(
					'The given type value must be one of the valid string : "%s".',
					join(', ', array_flip(static::$types))
				)
			);
		}
		
		$this->type = $type;
		
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getPurposes()
	{
		return $this->purposes;
	}
	
	/**
	 * @param string $purposes
	 *
	 * @return Consultation
	 */
	public function setPurposes($purposes)
	{
		$this->purposes = $purposes;
		
		return $this;
	}
	
	public function __toString()
	{
		return $this->date->format('d/m/Y');
	}
}