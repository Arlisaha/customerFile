<?php

namespace AppBundle\Entity\Customer;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use \DateTime;

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
	 * @ORM\Column(name="last_name", type="string", length=255, nullable=true)
	 */
	private $lastName;

	/**
	 * @ORM\Column(name="birth_date", type="datetime", nullable=true)
	 */
	private $birthDate;

	/**
	 * @ORM\Column(name="gender", type="binary", nullable=true)
	 */
	private $gender;

	/**
	 * @ORM\Column(name="job", type="string", length=255, nullable=true)
	 */
	private $job;

	/**
	 * @ORM\Column(name="phone", type="string", length=10, nullable=true)
	 */
	private $phone;

	/**
	 * @ORM\Column(name="email", type="string", length=255, nullable=true)
	 */
	private $email;

	/**
	 * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Customer\LifeStyle")
	 * @ORM\JoinTable(name="l__owner_life_style",
	 *     joinColumns={@ORM\JoinColumn(name="owner_id", referencedColumnName="id")},
	 *     inverseJoinColumns={@ORM\JoinColumn(name="life_style_id", referencedColumnName="id")}
	 * )
	 */
	private $lifeStyle;

	/**
	 * @ORM\Column(name="comment", type="text", nullable=true)
	 */
	private $comment;

	/**
	 * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Customer\Customer", inversedBy="owners")
	 * @ORM\JoinColumn(name="customer_id", referencedColumnName="id")
	 */
	private $customer;

	public static $genders = [
		0 => 'homme',
		1 => 'femme',
	];

	public function __construct()
	{
		$this->lifeStyle = new ArrayCollection();
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
	 * @return Owner
	 */
	public function setId($id)
	{
		$this->id = $id;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getFirstName()
	{
		return $this->firstName;
	}

	/**
	 * @param string $firstName
	 *
	 * @return Owner
	 */
	public function setFirstName($firstName)
	{
		$this->firstName = $firstName;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getLastName()
	{
		return $this->lastName;
	}

	/**
	 * @param string $lastName
	 *
	 * @return Owner
	 */
	public function setLastName($lastName)
	{
		$this->lastName = $lastName;

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
	 * @return Owner
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
	 * @return Owner
	 */
	public function setGender($gender)
	{
		if (!array_key_exists($gender, static::$genders) && !in_array($gender, static::$genders)) {
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
	 * @return string
	 */
	public function getJob()
	{
		return $this->job;
	}

	/**
	 * @param string $job
	 *
	 * @return Owner
	 */
	public function setJob($job)
	{
		$this->job = $job;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getPhone()
	{
		return $this->phone;
	}

	/**
	 * @param string $phone
	 *
	 * @return Owner
	 */
	public function setPhone($phone)
	{
		$this->phone = $phone;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getEmail()
	{
		return $this->email;
	}

	/**
	 * @param string $email
	 *
	 * @return Owner
	 */
	public function setEmail($email)
	{
		$this->email = $email;

		return $this;
	}

	/**
	 * @return ArrayCollection
	 */
	public function getLifeStyle()
	{
		return $this->lifeStyle;
	}

	/**
	 * @param ArrayCollection $lifeStyle
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
	 * @return Owner
	 */
	public function addLifeStyle(LifeStyle $lifeStyle)
	{
		$this->lifeStyle->add($lifeStyle);

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
	 * @return Owner
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
	 * @return Owner
	 */
	public function setCustomer(Customer $customer)
	{
		$this->customer = $customer;

		return $this;
	}

	public function __toString()
	{
		return $this->lastName;
	}
}