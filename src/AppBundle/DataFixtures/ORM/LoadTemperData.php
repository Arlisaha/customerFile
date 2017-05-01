<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Animal\Temper;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadTemperData extends AbstractFixture implements OrderedFixtureInterface
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

	public function getOrder()
	{
		return 3;
	}
}