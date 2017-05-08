<?php

namespace AppBundle\Entity\Animal;

use \DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
	 * @ORM\JoinColumn(name="breed_id", referencedColumnName="id", nullable=true)
	 *
	 * @var DogBreed
	 */
	private $breed;

	/**
	 * @ORM\Column(name="daily_walk_time", type="time", nullable=true)
	 *
	 * @Assert\Time()
	 *
	 * @var DateTime
	 */
	private $dailyWalkTime;

	/**
	 * @return DogBreed
	 */
	public function getBreed()
	{
		return $this->breed;
	}

	/**
	 * @param DogBreed $breed
	 *
	 * @return Dog
	 */
	public function setBreed(DogBreed $breed)
	{
		$this->breed = $breed;

		return $this;
	}

	/**
	 * @return DateTime
	 */
	public function getDailyWalkTime()
	{
		return $this->dailyWalkTime;
	}

	/**
	 * @param DateTime $dailyWalkTime
	 *
	 * @return Dog
	 */
	public function setDailyWalkTime(DateTime $dailyWalkTime = null)
	{
		$this->dailyWalkTime = $dailyWalkTime;

		return $this;
	}
}