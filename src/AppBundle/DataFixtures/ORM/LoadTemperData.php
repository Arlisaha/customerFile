<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Temper;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadTemperData implements FixtureInterface
{
	private static $temperTypeList = [
		'Curieux',
		'Agressif',
		'Défensif',
		'Timide',
		'Joueur',
		'Vif',
	];

	public function load(ObjectManager $manager)
	{
		foreach (self::$temperTypeList as $temperType) {
			$temper = new Temper();
			$temper->setLabel($temperType);

			$manager->persist($temper);
		}

		$manager->flush();
	}
}