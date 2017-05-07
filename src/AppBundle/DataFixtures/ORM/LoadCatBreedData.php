<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Animal\CatBreed;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadCatBreedData extends AbstractFixture implements OrderedFixtureInterface
{
	private static $breedNameList = [
		'fixtures.breed.cat.turkish_angora',
		'fixtures.breed.cat.maine_coon',
		'fixtures.breed.cat.persian',
		'fixtures.breed.cat.european_shortair',
		'fixtures.breed.cat.sphynx',
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