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
	 * @ORM\Column(name="daily_walk_time", type="float")
	 */
	private $dailyWalkTime;

	/**
	 * @ORM\Column(name="daily_walk_time_unit", type="binary")
	 */
	private $dailyWalkTimeUnit;

	public static $dailyWalkTimeUnits = [
		0 => 'minutes',
		1 => 'heures',
	];

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

	/**
	 * @return mixed
	 */
	public function getDailyWalkTime()
	{
		return $this->dailyWalkTime;
	}

	/**
	 * @param mixed $dailyWalkTime
	 *
	 * @return Dog
	 */
	public function setDailyWalkTime($dailyWalkTime)
	{
		$this->dailyWalkTime = $dailyWalkTime;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getDailyWalkTimeUnit()
	{
		return $this->dailyWalkTimeUnit;
	}

	/**
	 * @param mixed $dailyWalkTimeUnit
	 *
	 * @return Dog
	 */
	public function setDailyWalkTimeUnit($dailyWalkTimeUnit)
	{
		$this->dailyWalkTimeUnit = $dailyWalkTimeUnit;

		return $this;
	}
}