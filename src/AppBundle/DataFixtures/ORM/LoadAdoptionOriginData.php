<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Animal\AdoptionOrigin;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadAdoptionOriginData extends AbstractFixture implements OrderedFixtureInterface
{
	private static $adoptionOriginList = [
			'association' => 'fixtures.adoption_origin.association',
			'private'     => 'fixtures.adoption_origin.private',
			'raiser'      => 'fixtures.adoption_origin.raiser',
			'pet_shop'    => 'fixtures.adoption_origin.pet_shop',
			'other'       => 'fixtures.adoption_origin.other',
		];
	
	public function load(ObjectManager $manager)
	{
		foreach (self::$adoptionOriginList as $adoptionOrigin) {
			$origin = new AdoptionOrigin();
			$origin->setLabel($adoptionOrigin);
			
			$manager->persist($origin);
		}
		
		$manager->flush();
	}
	
	public function getOrder()
	{
		return 5;
	}
}