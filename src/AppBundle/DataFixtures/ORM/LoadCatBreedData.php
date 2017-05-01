<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Animal\CatBreed;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadCatBreedData extends AbstractFixture implements OrderedFixtureInterface
{
	private static $breedNameList = [
		'angora',
		'persan',
		'européen',
		'sphinx',
	];

	public function load(ObjectManager $manager)
	{
		foreach (self::$breedNameList as $breedName) {
			$breed = new CatBreed();
			$breed->setLabel($breedName);

			$manager->persist($breed);
		}

		$manager->flush();
	}

	public function getOrder()
	{
		return 1;
	}
}