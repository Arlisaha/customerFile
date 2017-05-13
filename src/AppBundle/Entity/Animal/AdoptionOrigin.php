<?php

namespace AppBundle\Entity\Animal;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class AdoptionOrigin
 * @package AppBundle\Entity\Animal
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Animal\AdoptionOriginRepository")
 * @ORM\Table(name="adoption_origin")
 */
class AdoptionOrigin
{
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\Column(name="id", type="integer", nullable=false)
	 *
	 * @var int
	 */
	private $id;

	/**
	 * @ORM\Column(name="name", type="string", length=255, nullable=false)
	 *
	 * @Assert\NotBlank()
	 * @Assert\Type(type="string")
	 *
	 * @var string
	 */
	private $label;

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
	 * @return AdoptionOrigin
	 */
	public function setId($id)
	{
		$this->id = $id;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getLabel()
	{
		return $this->label;
	}

	/**
	 * @param string $label
	 *
	 * @return AdoptionOrigin
	 */
	public function setLabel($label)
	{
		$this->label = $label;

		return $this;
	}

	public function __toString()
	{
		return $this->label;
	}
}