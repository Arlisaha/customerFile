<?php

namespace AppBundle\Entity\Animal;

use AppBundle\Entity\Customer\Customer;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use \DateTime;

/**
 * Class AbstractAnimal
 * @package AppBundle\Entity\Animal
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Animal\AnimalRepository")
 * @ORM\Table(name="animal")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="specie", type="string", length=3)
 * @ORM\DiscriminatorMap({"dog" = "Dog", "cat" = "Cat"})
 */
abstract class AbstractAnimal
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
	 * @ORM\Column(name="name", type="string", length=255, nullable=false)
	 *
	 * @Assert\NotBlank()
	 * @Assert\Type(type="string")
	 *
	 * @var string
	 */
	private $name;

	/**
	 * @ORM\Column(name="birth_date", type="datetime", nullable=true)
	 *
	 * @Assert\Date()
	 *
	 * @var DateTime
	 */
	private $birthDate;

	/**
	 * @ORM\Column(name="gender", type="string", length=6, nullable=false)
	 *
	 * @Assert\Choice(choices={"male", "female"}, message="Choose a valid gender")
	 *
	 * @var string
	 */
	private $gender;

	/**
	 * @ORM\Column(name="castrated", type="boolean", nullable=false)
	 *
	 * @Assert\Type(type="bool")
	 *
	 * @var bool
	 */
	private $castrated;

	/**
	 * @ORM\Column(name="weight", type="float", nullable=true)
	 *
	 * @Assert\GreaterThan(value="0")
	 *
	 * @var float
	 */
	private $weight;

	/**
	 * @ORM\Column(name="size", type="float", nullable=true)
	 *
	 * @Assert\GreaterThan(value="0")
	 *
	 * @var float
	 */
	private $size;

	/**
	 * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Animal\Temper")
	 * @ORM\JoinTable(name="l__animal_temper",
	 *     joinColumns={@ORM\JoinColumn(name="animal_id", referencedColumnName="id")},
	 *     inverseJoinColumns={@ORM\JoinColumn(name="temper_id", referencedColumnName="id")}
	 * )
	 *
	 * @var Temper
	 */
	private $temper;

	/**
	 * @ORM\Column(name="living_outside", type="boolean", nullable=true)
	 *
	 * @Assert\Type(type="bool")
	 *
	 * @var bool
	 */
	private $livingOutside;

	/**
	 * @ORM\Column(name="outside_time", type="time", nullable=true)
	 *
	 * @Assert\Time()
	 *
	 * @var DateTime
	 */
	private $outsideTime;

	/**
	 * @ORM\Column(name="health_issues", type="text", nullable=true)
	 *
	 * @Assert\Type(type="string")
	 *
	 * @var string
	 */
	private $healthIssues;

	/**
	 * @ORM\Column(name="comment", type="text", nullable=true)
	 *
	 * @Assert\Type(type="string")
	 *
	 * @var string
	 */
	private $comment;

	/**
	 * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Customer\Customer", inversedBy="animals", cascade={"persist"})
	 *
	 * @var Customer
	 */
	private $customer;

	/**
	 * @ORM\Column(name="adopted_from_association", type="boolean", nullable=true)
	 *
	 * @Assert\Type(type="bool")
	 *
	 * @var bool
	 */
	private $adoptedFromAssociation;

	public static $genders = [
		'male'   => 'entity.animal.gender.male',
		'female' => 'entity.animal.gender.female',
	];

	/**
	 * AbstractAnimal constructor.
	 */
	public function __construct()
	{
		$this->temper = new ArrayCollection();
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
	 * @return AbstractAnimal
	 */
	public function setId($id)
	{
		$this->id = $id;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @param string $name
	 *
	 * @return AbstractAnimal
	 */
	public function setName($name)
	{
		$this->name = $name;

		return $this;
	}

	/**
	 * @return DateTime
	 */
	public function getBirthDate()
	{
		return $this->birthDate;
	}

	/**
	 * @param DateTime $birthDate
	 *
	 * @return AbstractAnimal
	 */
	public function setBirthDate(DateTime $birthDate)
	{
		$this->birthDate = $birthDate;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getGender()
	{
		return $this->gender;
	}

	/**
	 * @param int|string $gender
	 *
	 * @return AbstractAnimal
	 */
	public function setGender($gender)
	{
		if (!is_string($gender) || !array_key_exists($gender, static::$genders)) {
			throw new \InvalidArgumentException(
				sprintf(
					'The given gender value must be one of the valid string : "%s".',
					join(', ', array_flip(static::$genders))
				)
			);
		}

		$this->gender = $gender;

		return $this;
	}

	/**
	 * @return bool
	 */
	public function isCastrated()
	{
		return $this->castrated;
	}

	/**
	 * @param bool $castrated
	 *
	 * @return AbstractAnimal
	 */
	public function setCastrated($castrated)
	{
		$this->castrated = $castrated;

		return $this;
	}

	/**
	 * @return float
	 */
	public function getWeight()
	{
		return $this->weight;
	}

	/**
	 * @param float $weight
	 *
	 * @return AbstractAnimal
	 */
	public function setWeight($weight)
	{
		$this->weight = $weight;

		return $this;
	}

	/**
	 * @return float
	 */
	public function getSize()
	{
		return $this->size;
	}

	/**
	 * @param float $size
	 *
	 * @return AbstractAnimal
	 */
	public function setSize($size)
	{
		$this->size = $size;

		return $this;
	}

	/**
	 * @return ArrayCollection
	 */
	public function getTemper()
	{
		return $this->temper;
	}

	/**
	 * @param ArrayCollection $temper
	 *
	 * @return AbstractAnimal
	 */
	public function setTemper($temper)
	{
		$this->temper = $temper;

		return $this;
	}

	/**
	 * @param Temper $temper
	 *
	 * @return AbstractAnimal
	 */
	public function addTemper(Temper $temper)
	{
		$this->temper->add($temper);

		return $this;
	}

	/**
	 * @param Temper $temper
	 *
	 * @return AbstractAnimal
	 */
	public function removeTemper(Temper $temper)
	{
		$this->temper->remove($temper);

		return $this;
	}

	/**
	 * @return bool
	 */
	public function isLivingOutside()
	{
		return $this->livingOutside;
	}

	/**
	 * @param bool $livingOutside
	 *
	 * @return AbstractAnimal
	 */
	public function setLivingOutside($livingOutside)
	{
		$this->livingOutside = $livingOutside;

		return $this;
	}

	/**
	 * @return float
	 */
	public function getOutsideTime()
	{
		return $this->outsideTime;
	}

	/**
	 * @param float $outsideTime
	 *
	 * @return AbstractAnimal
	 */
	public function setOutsideTime($outsideTime)
	{
		$this->outsideTime = $outsideTime;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getHealthIssues()
	{
		return $this->healthIssues;
	}

	/**
	 * @param string $healthIssues
	 *
	 * @return AbstractAnimal
	 */
	public function setHealthIssues($healthIssues)
	{
		$this->healthIssues = $healthIssues;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getComment()
	{
		return $this->comment;
	}

	/**
	 * @param string $comment
	 *
	 * @return AbstractAnimal
	 */
	public function setComment($comment)
	{
		$this->comment = $comment;

		return $this;
	}

	/**
	 * @return Customer
	 */
	public function getCustomer()
	{
		return $this->customer;
	}

	/**
	 * @param Customer $customer
	 *
	 * @return AbstractAnimal
	 */
	public function setCustomer(Customer $customer)
	{
		$this->customer = $customer;

		return $this;
	}

	/**
	 * @return bool
	 */
	public function isAdoptedFromAssociation()
	{
		return $this->adoptedFromAssociation;
	}

	/**
	 * @param bool $adoptedFromAssociation
	 *
	 * @return AbstractAnimal
	 */
	public function setAdoptedFromAssociation($adoptedFromAssociation)
	{
		$this->adoptedFromAssociation = $adoptedFromAssociation;

		return $this;
	}

	public function __toString()
	{
		return $this->name;
	}
}