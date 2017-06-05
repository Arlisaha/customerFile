<?php

namespace AppBundle\Repository\CustomerCard;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

class CustomerCardRepository extends EntityRepository
{
	public function findAllLimit($firstResult, $maxResult)
	{
		$qb = $this->createQueryBuilder('cc');

		$qb
			->orderBy('cc.id', 'ASC')
			->setFirstResult($firstResult)
			->setMaxResults($maxResult);

		return new Paginator($qb);
	}

	public function findByOwnerAndAnimal($ownerLastName = null, $ownerFirstName = null, $animalName = null, $animalSpecie)
	{
		$qb = $this->createQueryBuilder('cc');

		$qb
			->innerJoin('cc.customer', 'c')
			->innerJoin('c.owners', 'o')
			->innerJoin('c.animals', 'a')
			->where($queryBuilder->expr()->like('o.firstName', ':firstname'))
			->andWhere($queryBuilder->expr()->like('o.lastName', ':lastname'))
			->andWhere('a.name', ':animal_name')
			->andWhere('a.specie', ':animal_specie')
			->orderBy('cc.id', 'ASC')
			->setFirstResult($firstResult)
			->setMaxResults($maxResult)
			->setParameters([
				'firstname'     => $ownerLastName,
				'lastname'      => $ownerFirstName,
				'animal_name'   => $animalName,
				'animal_specie' => $animalSpecie,
			]);
	}
}