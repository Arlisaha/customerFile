<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\AgeType;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadAgeTypeData implements FixtureInterface
{
	private static $ageTypeNameList = [
		'mois',
		'ans',
	];

	public function load(ObjectManager $manager)
	{
		foreach (self::$ageTypeNameList as $ageTypeName) {
			$ageType = new AgeType();
			$ageType->setName($ageTypeName);

			$manager->persist($ageType);
		}

		$manager->flush();
	}
}