<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Animal\DogBreed;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadDogBreedData extends AbstractFixture implements OrderedFixtureInterface
{
	private static $breedNameList = [
		'berger allemand',
		'shih-tzu',
		'bouledogue français',
		'bouledogue anglais',
		'bauceron',
		'dalmatien',
		'chihuahua',
		'yorkshire',
		'bouvier bernois',
	];

	public function load(ObjectManager $manager)
	{
		foreach (self::$breedNameList as $breedName) {
			$breed = new DogBreed();
			$breed->setLabel($breedName);

			$manager->persist($breed);
		}

		$manager->flush();
	}

	public function getOrder()
	{
		return 2;
	}
}