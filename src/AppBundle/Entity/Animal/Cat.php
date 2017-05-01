<?php

namespace AppBundle\Entity\Animal;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Dog
 * @package AppBundle\Entity\Animal
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Animal\CatRepository")
 */
class Cat extends AbstractAnimal
{
	/**
	 * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Animal\CatBreed")
	 * @ORM\JoinColumn(name="breed_id", referencedColumnName="id")
	 */
	private $breed;

	/**
	 * @return CatBreed
	 */
	public function getBreed()
	{
		return $this->breed;
	}

	/**
	 * @param mixed $breed
	 *
	 * @return Cat
	 */
	public function setBreed(CatBreed $breed)
	{
		$this->breed = $breed;

		return $this;
	}
}