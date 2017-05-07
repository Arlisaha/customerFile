<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Animal\DogBreed;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadDogBreedData extends AbstractFixture implements OrderedFixtureInterface
{
	private static $breedNameList = [
		'fixtures.breed.dog.german_shepperd',
		'fixtures.breed.dog.shih_tzu',
		'fixtures.breed.dog.french_bulldog',
		'fixtures.breed.dog.bulldog',
		'fixtures.breed.dog.beauceron',
		'fixtures.breed.dog.dalmatian',
		'fixtures.breed.dog.chihuahua',
		'fixtures.breed.dog.yorkshire',
		'fixtures.breed.dog.bernese_moutain_dog',
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