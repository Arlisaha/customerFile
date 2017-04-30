<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Character;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadCharacterData implements FixtureInterface
{
	private static $characterTypeList = [
		'Curieux',
		'Agressif',
		'Défensif',
		'Timide',
		'Joueur',
		'Vif',
	];

	public function load(ObjectManager $manager)
	{
		foreach (self::$characterTypeList as $characterType) {
			$character = new Character();
			$character->setLabel($characterType);

			$manager->persist($character);
		}

		$manager->flush();
	}
}