<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Customer\LifeStyle;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadLifeStyleData extends AbstractFixture implements OrderedFixtureInterface
{
	private static $lifeStyleTypesList = [
		'fixtures.life_style.sportive',
		'fixtures.life_style.homebody',
	];

	public function load(ObjectManager $manager)
	{
		foreach (self::$lifeStyleTypesList as $lifeStyleType) {
			$lifeStyle = new LifeStyle();
			$lifeStyle->setLabel($lifeStyleType);

			$manager->persist($lifeStyle);
		}

		$manager->flush();
	}

	public function getOrder()
	{
		return 4;
	}
}