<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\AnimalGender;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadAnimalGenderData implements FixtureInterface
{
	private static $animalGenderNameList = [
		'mâle',
		'femelle',
	];

	public function load(ObjectManager $manager)
	{
		foreach (self::$animalGenderNameList as $animalGenderName) {
			$animalGender = new AnimalGender();
			$animalGender->setLabel($animalGenderName);

			$manager->persist($animalGender);
		}

		$manager->flush();
	}
}