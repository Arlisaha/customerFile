<?php

namespace AppBundle\Entity\Owner;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Gender
 * @package AppBundle\Entity\Owner
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Owner\OwnerRepository")
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
	 * @ORM\Column(name="firstname", type="string", length=255)
	 */
	private $firstname;

	/**
	 * @ORM\Column(name="lastname", type="string", length=255)
	 */
	private $lastname;

	/**
	 * @ORM\Column(name="age", type="integer")
	 */
	private $age;

	/**
	 * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Owner\Gender")
	 * @ORM\JoinColumn(name="gender_id", referencedColumnName="id")
	 */
	private $gender;

	/**
	 * @ORM\Column(name="job", type="string", length=255, nullable=true)
	 */
	private $job;

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
	public function getFirstname()
	{
		return $this->firstname;
	}

	/**
	 * @param mixed $firstname
	 *
	 * @return Owner
	 */
	public function setFirstname($firstname)
	{
		$this->firstname = $firstname;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getLastname()
	{
		return $this->lastname;
	}

	/**
	 * @param mixed $lastname
	 *
	 * @return Owner
	 */
	public function setLastname($lastname)
	{
		$this->lastname = $lastname;

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