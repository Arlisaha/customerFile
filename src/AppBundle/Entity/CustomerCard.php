<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Consultation\Consultation;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class CustomerCard
 * @package AppBundle\Entity
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CustomerCardRepository")
 * @ORM\Table(name="customer_card")
 */
class CustomerCard
{
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\Column(name="id", type="integer")
	 */
	private $id;

	/**
	 * @ORM\OneToOne(targetEntity="AppBundle\Entity\Customer\Customer", inversedBy="customerCard")
	 * @ORM\JoinColumn(name="customer_id", referencedColumnName="id")
	 */
	private $customer;

	/**
	 * @ORM\OneToMany(targetEntity="AppBundle\Entity\Consultation\Consultation", mappedBy="id")
	 */
	private $consultations;

	/**
	 * @ORM\Column(name="comments", type="text")
	 */
	private $comments;

	public function __construct()
	{
		$this->consultations = new ArrayCollection();
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
	 * @return CustomerCard
	 */
	public function setId($id)
	{
		$this->id = $id;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getCustomer()
	{
		return $this->customer;
	}

	/**
	 * @param mixed $customer
	 *
	 * @return CustomerCard
	 */
	public function setCustomer($customer)
	{
		$this->customer = $customer;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getConsultations()
	{
		return $this->consultations;
	}

	/**
	 * @param mixed $consultations
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
	 * @return mixed
	 */
	public function getComments()
	{
		return $this->comments;
	}

	/**
	 * @param mixed $comments
	 *
	 * @return CustomerCard
	 */
	public function setComments($comments)
	{
		$this->comments = $comments;

		return $this;
	}
}