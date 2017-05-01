<?php

namespace AppBundle\Entity\Customer;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

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
	 * @ORM\Column(name="id", type="integer")
	 */
	private $id;

	/**
	 * @ORM\OneToMany(targetEntity="AppBundle\Entity\Customer\Owner", mappedBy="customer")
	 * @ORM\JoinTable(name="l__customer_owner",
	 *	 joinColumns={@ORM\JoinColumn(name="customer_id", referencedColumnName="id")},
	 *	 inverseJoinColumns={@ORM\JoinColumn(name="owner_id", referencedColumnName="id")}
	 * )
	 */
	private $owners;

	/**
	 * @ORM\Column(name="status", type="string", length=255)
	 */
	private $status;

	/**
	 * @ORM\Column(name="children", type="boolean")
	 */
	private $children;

	/**
	 * @ORM\Column(name="children_number", type="integer")
	 */
	private $childrenNumber;

	public function __construct()
	{
		$this->owners = new ArrayCollection();
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
	 * @return Customer
	 */
	public function setId($id)
	{
		$this->id = $id;

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
	 * @return Customer
	 */
	public function setOwners($owners)
	{
		$this->owners = $owners;

		return $this;
	}

	public function addOwner(Owner $owner)
	{
		$this->owners->add($owner);

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getStatus()
	{
		return $this->status;
	}

	/**
	 * @param mixed $status
	 *
	 * @return Customer
	 */
	public function setStatus($status)
	{
		$this->status = $status;

		return $this;
	}

	/**
	 * @return boolean
	 */
	public function hasChildren()
	{
		return $this->children;
	}

	/**
	 * @param mixed $children
	 *
	 * @return Customer
	 */
	public function setChildren($children)
	{
		$this->children = $children;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getChildrenNumber()
	{
		return $this->childrenNumber;
	}

	/**
	 * @param mixed $childrenNumber
	 *
	 * @return Customer
	 */
	public function setChildrenNumber($childrenNumber)
	{
		$this->childrenNumber = $childrenNumber;

		return $this;
	}
}