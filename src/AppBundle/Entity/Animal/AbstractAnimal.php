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
 * @ORM\DiscriminatorColumn(name="specie", type="integer")
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
	 * @ORM\Column(name="age_type", type="binary")
	 */
	private $ageType;

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
	 * @ORM\Column(name="comment", type="text")
	 */
	private $comment;

	public static $ageTypes = [
		0 => 'mois',
		1 => 'ans',
	];

	public static $genders = [
		0 => 'mâle',
		1 => 'femelle',
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
	public function getAgeType()
	{
		return $this->ageType;
	}

	/**
	 * @param mixed $ageType
	 *
	 * @return AbstractAnimal
	 */
	public function setAgeType(AgeType $ageType)
	{
		$this->ageType = $ageType;

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
	public function setGender(Gender $gender)
	{
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
	 * @return Temper
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
	public function setTemper(Temper $temper)
	{
		$this->temper = $temper;

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