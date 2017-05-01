<?php

namespace AppBundle\Entity\Animal;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class AbstractBreed
 * @package AppBundle\Entity\AbstractAnimal
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Animal\DogBreedRepository")
 */
class DogBreed extends AbstractBreed
{

}