<?php

namespace AppBundle\Entity\Animal;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class AbstractAnimal
 * @package AppBundle\Entity\Animal
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Animal\AnimalRepository")
 * @ORM\Table(name="animal")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="specie", type="binary")
 * @ORM\DiscriminatorMap({"0" = "Dog", "1" = "Cat"})
 */
abstract class AbstractAnimal
{
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\Column(name="id", type="integer")
	 */
	private $id;

	/**
	 * @ORM\Column(name="name", type="string", length=255)
	 */
	private $name;

	/**
	 * @ORM\Column(name="age_value", type="integer")
	 */
	private $ageValue;

	/**
	 * @ORM\Column(name="age_unit", type="binary")
	 */
	private $ageUnit;

	/**
	 * @ORM\Column(name="gender", type="binary")
	 */
	private $gender;

	/**
	 * @ORM\Column(name="castrated", type="boolean", nullable=false)
	 */
	private $castrated;

	/**
	 * @ORM\Column(name="weight", type="float")
	 */
	private $weight;

	/**
	 * @ORM\Column(name="size", type="float")
	 */
	private $size;

	/**
	 * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Animal\Temper")
	 * @ORM\JoinTable(name="l__animal_temper",
	 *	 joinColumns={@ORM\JoinColumn(name="animal_id", referencedColumnName="id")},
	 *	 inverseJoinColumns={@ORM\JoinColumn(name="temper_id", referencedColumnName="id")}
	 * )
	 */
	private $temper;

	/**
	 * @ORM\Column(name="living_outside", type="boolean")
	 */
	private $livingOutside;

	/**
	 * @ORM\Column(name="outside_time", type="float")
	 */
	private $outsideTime;

	/**
	 * @ORM\Column(name="outside_time_unit", type="binary")
	 */
	private $outsideTimeUnit;

	/**
	 * @ORM\Column(name="health_issues", type="text")
	 */
	private $healthIssues;

	/**
	 * @ORM\Column(name="comment", type="text")
	 */
	private $comment;

	public static $ageUnits = [
		0 => 'mois',
		1 => 'ans',
	];

	public static $genders = [
		0 => 'mâle',
		1 => 'femelle',
	];

	public static $outsideTimeUnits = [
		0 => 'minutes',
		1 => 'heures',
	];

	public function __construct()
	{
		$this->temper = new ArrayCollection();
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
	 * @return AbstractAnimal
	 */
	public function setId($id)
	{
		$this->id = $id;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @param mixed $name
	 *
	 * @return AbstractAnimal
	 */
	public function setName($name)
	{
		$this->name = $name;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getAgeValue()
	{
		return $this->ageValue;
	}

	/**
	 * @param mixed $ageValue
	 *
	 * @return AbstractAnimal
	 */
	public function setAgeValue($ageValue)
	{
		$this->ageValue = $ageValue;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getAgeUnit()
	{
		return $this->ageUnit;
	}

	/**
	 * @param mixed $ageUnit
	 *
	 * @return AbstractAnimal
	 */
	public function setAgeUnit($ageUnit)
	{
		if(!array_key_exists($ageUnit, static::$ageUnits) && !in_array($ageUnit, static::$ageUnits)) {
			throw new \InvalidArgumentException(
				sprintf(
					'The given time unit value must be either a valid string (%s) nor a valid int key (%s).',
					join(', ', static::$ageUnits),
					join(', ', array_flip(static::$ageUnits))
				)
			);
		}

		if (is_string($ageUnit)) {
			$ageUnit = array_flip(static::$ageUnits)[$ageUnit];
		}

		$this->ageUnit = $ageUnit;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getGender()
	{
		return $this->gender;
	}

	/**
	 * @param mixed $gender
	 *
	 * @return AbstractAnimal
	 */
	public function setGender($gender)
	{
		if(!array_key_exists($gender, static::$genders) && !in_array($gender, static::$genders)) {
			throw new \InvalidArgumentException(
				sprintf(
					'The given time unit value must be either a valid string (%s) nor a valid int key (%s).',
					join(', ', static::$genders),
					join(', ', array_flip(static::$genders))
				)
			);
		}

		if (is_string($gender)) {
			$gender = array_flip(static::$genders)[$gender];
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
	 * @param mixed $castrated
	 *
	 * @return AbstractAnimal
	 */
	public function setCastrated($castrated)
	{
		$this->castrated = $castrated;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getWeight()
	{
		return $this->weight;
	}

	/**
	 * @param mixed $weight
	 *
	 * @return AbstractAnimal
	 */
	public function setWeight($weight)
	{
		$this->weight = $weight;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getSize()
	{
		return $this->size;
	}

	/**
	 * @param mixed $size
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
	 * @param mixed $temper
	 *
	 * @return AbstractAnimal
	 */
	public function setTemper(ArrayCollection $temper)
	{
		$this->temper = $temper;

		return $this;
	}

	public function addTemper(Temper $temper)
	{
		$this->temper->add($temper);

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function isLivingOutside()
	{
		return $this->livingOutside;
	}

	/**
	 * @param mixed $livingOutside
	 *
	 * @return AbstractAnimal
	 */
	public function setLivingOutside($livingOutside)
	{
		$this->livingOutside = $livingOutside;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getOutsideTime()
	{
		return $this->outsideTime;
	}

	/**
	 * @param mixed $outsideTime
	 *
	 * @return AbstractAnimal
	 */
	public function setOutsideTime($outsideTime)
	{
		$this->outsideTime = $outsideTime;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getOutsideTimeUnit()
	{
		return $this->outsideTimeUnit;
	}

	/**
	 * @param mixed $outsideTimeUnit
	 *
	 * @return AbstractAnimal
	 */
	public function setOutsideTimeUnit($outsideTimeUnit)
	{
		if(!array_key_exists($outsideTimeUnit, static::$outsideTimeUnits) && !in_array($outsideTimeUnit, static::$outsideTimeUnits)) {
			throw new \InvalidArgumentException(
				sprintf(
					'The given time unit value must be either a valid string (%s) nor a valid int key (%s).',
					join(', ', static::$outsideTimeUnits),
					join(', ', array_flip(static::$outsideTimeUnits))
				)
			);
		}

		if (is_string($outsideTimeUnit)) {
			$outsideTimeUnit = array_flip(static::$outsideTimeUnits)[$outsideTimeUnit];
		}

		$this->outsideTimeUnit = $outsideTimeUnit;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getHealthIssues()
	{
		return $this->healthIssues;
	}

	/**
	 * @param mixed $healthIssues
	 *
	 * @return AbstractAnimal
	 */
	public function setHealthIssues($healthIssues)
	{
		$this->healthIssues = $healthIssues;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getComment()
	{
		return $this->comment;
	}

	/**
	 * @param mixed $comment
	 *
	 * @return AbstractAnimal
	 */
	public function setComment($comment)
	{
		$this->comment = $comment;

		return $this;
	}
}