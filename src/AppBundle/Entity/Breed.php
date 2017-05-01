<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Breed
 * @package AppBundle\Entity
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BreedRepository")
 * @ORM\Table(name="breed")
 */
class Breed
{
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\Column(name="id", type="integer")
	 */
	private $id;

	/**
	 * @ORM\OneToOne(targetEntity="AppBundle\Entity\Specie")
	 * @ORM\JoinColumn(name="specie_id", referencedColumnName="id")
	 */
	private $specie;

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
	 * @return Breed
	 */
	public function setId($id)
	{
		$this->id = $id;

		return $this;
	}

	/**
	 * @return Specie
	 */
	public function getSpecie()
	{
		return $this->specie;
	}

	/**
	 * @param Specie $specie
	 *
	 * @return Breed
	 */
	public function setSpecie(Specie $specie)
	{
		$this->specie = $specie;

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
	 * @return Breed
	 */
	public function setLabel($label)
	{
		$this->label = $label;

		return $this;
	}
}