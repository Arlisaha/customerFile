<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Animal\AgeType;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadAgeTypeData extends AbstractFixture implements OrderedFixtureInterface
{
	private static $ageTypeNameList = [
		'mois',
		'ans',
	];

	public function load(ObjectManager $manager)
	{
		foreach (self::$ageTypeNameList as $ageTypeName) {
			$ageType = new AgeType();
			$ageType->setLabel($ageTypeName);

			$manager->persist($ageType);
		}

		$manager->flush();
	}

	public function getOrder()
	{
		return 5;
	}
}