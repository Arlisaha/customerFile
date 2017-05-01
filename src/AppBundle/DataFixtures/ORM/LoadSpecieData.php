<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Breed;
use AppBundle\Entity\Specie;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadSpecieData extends AbstractFixture implements OrderedFixtureInterface
{
	private static $specieNameList = [
		'chien',
		'chat',
	];

	public function load(ObjectManager $manager)
	{
		foreach (self::$specieNameList as $specieName) {
			$specie = new Specie();
			$specie->setLabel($specieName);

			$manager->persist($specie);

			$this->addReference($specieName, $specie);
		}

		$manager->flush();
	}

	public function getOrder()
	{
		return 1;
	}
}