<?php

namespace AppBundle\Entity\CustomerCard;

use AppBundle\Entity\Customer\Customer;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class CustomerCard
 * @package AppBundle\Entity\CustomerCard
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CustomerCard\CustomerCardRepository")
 * @ORM\Table(name="customer_card")
 */
class CustomerCard
{
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\Column(name="id", type="integer",nullable=false)
	 *
	 * @var int
	 */
	private $id;

	/**
	 * @ORM\OneToOne(targetEntity="AppBundle\Entity\Customer\Customer", inversedBy="customerCard", cascade={"persist"})
	 * @ORM\JoinColumn(name="customer_id", referencedColumnName="id", nullable=false)
	 *
	 * @var Customer
	 */
	private $customer;

	/**
	 * @ORM\OneToMany(targetEntity="AppBundle\Entity\CustomerCard\Consultation", mappedBy="customerCard", cascade={"persist"})
	 *
	 * @var Consultation[]
	 */
	private $consultations;

	/**
	 * @ORM\Column(name="comments", type="text", nullable=true)
	 *
	 * @Assert\Type(type="string")
	 *
	 * @var string
	 */
	private $comments;

	public function __construct()
	{
		$this->consultations = new ArrayCollection();
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
	 * @return CustomerCard
	 */
	public function setId($id)
	{
		$this->id = $id;

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
	 * @return CustomerCard
	 */
	public function setCustomer(Customer $customer)
	{
		$this->customer = $customer;

		return $this;
	}

	/**
	 * @return ArrayCollection
	 */
	public function getConsultations()
	{
		return $this->consultations;
	}

	/**
	 * @param ArrayCollection $consultations
	 *
	 * @return CustomerCard
	 */
	public function setConsultations($consultations)
	{
		$this->consultations = $consultations;

		return $this;
	}

	/**
	 * @param Consultation $consultation
	 *
	 * @return $this
	 */
	public function addConsultation(Consultation $consultation)
	{
		$this->consultations->add($consultation);

		return $this;
	}

	/**
	 * @param Consultation $consultation
	 *
	 * @return $this
	 */
	public function removeConsultation(Consultation $consultation)
	{
		$this->consultations->removeElement($consultation);

		return $this;
	}

	/**
	 * @return string
	 */
	public function getComments()
	{
		return $this->comments;
	}

	/**
	 * @param string $comments
	 *
	 * @return CustomerCard
	 */
	public function setComments($comments)
	{
		$this->comments = $comments;

		return $this;
	}

	public function __toString()
	{
		return (string)$this->id;
	}
}