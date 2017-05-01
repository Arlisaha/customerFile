<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Animal\Breed;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadBreedData extends AbstractFixture implements OrderedFixtureInterface
{
	private static $breedNameList = [
		'berger allemand'     => 'chien',
		'shih-tzu'            => 'chien',
		'bouledogue français' => 'chien',
		'bouledogue anglais'  => 'chien',
		'bauceron'            => 'chien',
		'dalmatien'           => 'chien',
		'chihuahua'           => 'chien',
		'yorkshire'           => 'chien',
		'bouvier bernois'     => 'chien',
		'angora'              => 'chat',
		'persan'              => 'chat',
		'européen'            => 'chat',
		'sphinx'              => 'chat',
	];

	public function load(ObjectManager $manager)
	{
		foreach (self::$breedNameList as $breedName => $specie) {
			$breed = new Breed();
			$breed->setSpecie($this->getReference($specie));
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