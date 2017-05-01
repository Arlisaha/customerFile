<?php

namespace AppBundle\Entity\Animal;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Dog
 * @package AppBundle\Entity\Animal
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Animal\DogRepository")
 */
class Dog extends AbstractAnimal
{
	/**
	 * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Animal\DogBreed")
	 * @ORM\JoinColumn(name="breed_id", referencedColumnName="id")
	 */
	private $breed;

	/**
	 * @return DogBreed
	 */
	public function getBreed()
	{
		return $this->breed;
	}

	/**
	 * @param mixed $breed
	 *
	 * @return Dog
	 */
	public function setBreed(DogBreed $breed)
	{
		$this->breed = $breed;

		return $this;
	}
}