<?php

namespace AppBundle\Entity\Customer;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class LifeStyle
 * @package AppBundle\Entity\Customer
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Customer\LifeStyleRepository")
 * @ORM\Table(name="life_style")
 */
class LifeStyle
{
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\Column(name="id", type="integer")
	 */
	private $id;

	/**
	 * @ORM\Column(name="label", type="string", length=255)
	 */
	private $label;

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
	 * @return LifeStyle
	 */
	public function setId($id)
	{
		$this->id = $id;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getLabel()
	{
		return $this->label;
	}

	/**
	 * @param mixed $label
	 *
	 * @return LifeStyle
	 */
	public function setLabel($label)
	{
		$this->label = $label;

		return $this;
	}
}