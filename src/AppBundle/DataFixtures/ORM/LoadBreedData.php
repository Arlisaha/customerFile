<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Breed;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadBreedData implements FixtureInterface
{
	private static $breedNameList = [
		'Berger Allemand',
		'Shih-tzu',
		'Bouledogue Français',
		'Bouledogue Anglais',
		'Bauceron',
		'Dalmatien',
		'Chihuahua',
		'Yorkshire',
		'Bouvier Bernois',
	];

	public function load(ObjectManager $manager)
	{
		foreach (self::$breedNameList as $breedName) {
			$breed = new Breed();
			$breed->setLabel($breedName);

			$manager->persist($breed);
		}

		$manager->flush();
	}
}