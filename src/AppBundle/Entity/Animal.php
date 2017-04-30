<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Animal
 * @package AppBundle\Entity
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AnimalRepository")
 * @ORM\Table(name="animal")
 */
class Animal
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
	 * @ORM\OneToOne(targetEntity="AppBundle\Entity\Breed")
	 * @ORM\JoinColumn(name="breed_id", referencedColumnName="id")
	 */
	private $breed;

	/**
	 * @ORM\Column(name="age_value", type="integer")
	 */
	private $ageValue;

	/**
	 * @ORM\OneToOne(targetEntity="AppBundle\Entity\AgeType")
	 * @ORM\JoinColumn(name="age_type_id", referencedColumnName="id")
	 */
	private $ageType;

	/**
	 * @ORM\OneToOne(targetEntity="AppBundle\Entity\AnimalGender")
	 * @ORM\JoinColumn(name="gender_id", referencedColumnName="id")
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
	 * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Character")
	 * @ORM\JoinTable(name="animal_character",
	 *	 joinColumns={@ORM\JoinColumn(name="animal_id", referencedColumnName="id")},
	 *	 inverseJoinColumns={@ORM\JoinColumn(name="character_id", referencedColumnName="id")}
	 * )
	 */
	private $character;

	/**
	 * @ORM\Column(name="comment", type="text")
	 */
	private $comment;

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
	 * @return Animal
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
	 * @return Animal
	 */
	public function setName($name)
	{
		$this->name = $name;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getBreed()
	{
		return $this->breed;
	}

	/**
	 * @param mixed $breed
	 *
	 * @return Animal
	 */
	public function setBreed($breed)
	{
		$this->breed = $breed;

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
	 * @return Animal
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
	 * @return Animal
	 */
	public function setAgeType($ageType)
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
	 * @return Animal
	 */
	public function setGender($gender)
	{
		$this->gender = $gender;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getCastrated()
	{
		return $this->castrated;
	}

	/**
	 * @param mixed $castrated
	 *
	 * @return Animal
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
	 * @return Animal
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
	 * @return Animal
	 */
	public function setSize($size)
	{
		$this->size = $size;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getCharacter()
	{
		return $this->character;
	}

	/**
	 * @param mixed $character
	 *
	 * @return Animal
	 */
	public function setCharacter($character)
	{
		$this->character = $character;

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
	 * @return Animal
	 */
	public function setComment($comment)
	{
		$this->comment = $comment;

		return $this;
	}
}