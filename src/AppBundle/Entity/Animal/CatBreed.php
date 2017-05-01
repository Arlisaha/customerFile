<?php

namespace AppBundle\Entity\Animal;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class AbstractBreed
 * @package AppBundle\Entity\AbstractAnimal
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Animal\CatBreedRepository")
 */
class CatBreed extends AbstractBreed
{

}