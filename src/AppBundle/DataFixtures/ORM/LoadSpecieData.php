<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Breed;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadSpecieData implements FixtureInterface
{
	private static $specieNameList = [
		'Chien',
		'Chat',
	];

	public function load(ObjectManager $manager)
	{
		foreach (self::$specieNameList as $specieName) {
			$specie = new Breed();
			$specie->setLabel($specieName);

			$manager->persist($specie);
		}

		$manager->flush();
	}
}