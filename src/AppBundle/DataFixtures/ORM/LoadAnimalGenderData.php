<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\AnimalGender;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadAnimalGenderData extends AbstractFixture implements OrderedFixtureInterface
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

	public function getOrder()
	{
		return 4;
	}
}