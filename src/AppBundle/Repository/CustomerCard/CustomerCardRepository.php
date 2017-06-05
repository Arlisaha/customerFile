<?php

namespace AppBundle\Repository\CustomerCard;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

class CustomerCardRepository extends EntityRepository
{
	public function findAllLimit($downLimit, $upLimit)
	{
		$qb = $this->createQueryBuilder('cc');

		$qb
			->orderBy('cc.id', 'ASC')
			->setFirstResult($downLimit)
			->setMaxResults($upLimit);

		return new Paginator($qb);
	}
}