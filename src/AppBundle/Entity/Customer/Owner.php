<?php

namespace AppBundle\Entity\Customer;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Gender
 * @package AppBundle\Entity\Customer
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Customer\OwnerRepository")
 * @ORM\Table(name="owner")
 */
class Owner
{
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\Column(name="id", type="integer")
	 */
	private $id;

	/**
	 * @ORM\Column(name="first_name", type="string", length=255)
	 */
	private $firstName;

	/**
	 * @ORM\Column(name="last_name", type="string", length=255)
	 */
	private $lastName;

	/**
	 * @ORM\Column(name="age", type="integer")
	 */
	private $age;

	/**
	 * @ORM\Column(name="gender", type="binary")
	 */
	private $gender;

	/**
	 * @ORM\Column(name="job", type="string", length=255, nullable=true)
	 */
	private $job;

	/**
	 * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Customer\LifeStyle")
	 * @ORM\JoinTable(name="l__owner_life_style",
	 *	 joinColumns={@ORM\JoinColumn(name="owner_id", referencedColumnName="id")},
	 *	 inverseJoinColumns={@ORM\JoinColumn(name="life_style_id", referencedColumnName="id")}
	 * )
	 */
	private $lifeStyle;

	/**
	 * @ORM\Column(name="comment", type="text")
	 */
	private $comment;

	public static $genders = [
		0 => 'homme',
		1 => 'femme',
	];

	public function __construct()
	{
		$this->lifeStyle = new ArrayCollection();
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
	 * @return Owner
	 */
	public function setId($id)
	{
		$this->id = $id;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getFirstName()
	{
		return $this->firstName;
	}

	/**
	 * @param mixed $firstName
	 *
	 * @return Owner
	 */
	public function setFirstName($firstName)
	{
		$this->firstName = $firstName;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getLastName()
	{
		return $this->lastName;
	}

	/**
	 * @param mixed $lastName
	 *
	 * @return Owner
	 */
	public function setLastName($lastName)
	{
		$this->lastName = $lastName;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getAge()
	{
		return $this->age;
	}

	/**
	 * @param mixed $age
	 *
	 * @return Owner
	 */
	public function setAge($age)
	{
		$this->age = $age;

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
	 * @return Owner
	 */
	public function setGender($gender)
	{
		if(!array_key_exists($gender, static::$genders) && !in_array($gender, static::$genders)) {
			throw new \InvalidArgumentException(
				sprintf(
					'The given gender value must be either a valid string (%s) nor a valid int key (%s).',
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
	 * @return mixed
	 */
	public function getJob()
	{
		return $this->job;
	}

	/**
	 * @param mixed $job
	 *
	 * @return Owner
	 */
	public function setJob($job)
	{
		$this->job = $job;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getLifeStyle()
	{
		return $this->lifeStyle;
	}

	/**
	 * @param mixed $lifeStyle
	 *
	 * @return Owner
	 */
	public function setLifeStyle($lifeStyle)
	{
		$this->lifeStyle = $lifeStyle;

		return $this;
	}

	/**
	 * @param LifeStyle $lifeStyle
	 *
	 * @return $this
	 */
	public function addLifeStyle(LifeStyle $lifeStyle)
	{
		$this->lifeStyle->add($lifeStyle);

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
	 * @return Owner
	 */
	public function setComment($comment)
	{
		$this->comment = $comment;

		return $this;
	}
}