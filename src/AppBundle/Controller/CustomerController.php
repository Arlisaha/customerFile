<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Animal\Cat;
use AppBundle\Entity\Animal\Dog;
use AppBundle\Entity\Customer\Customer;
use AppBundle\Form\Animal\AnimalType;
use AppBundle\Form\Customer\OwnerType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class CustomerController
 * @package AppBundle\Controller
 *
 * @Route("/customer")
 */
class CustomerController extends Controller
{
	/**
	 * @param Request $request
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 *
	 * @Route("/new", name="customer_new")
	 */
	public function newAction(Request $request)
	{
		$form = $this->createFormBuilder(new Customer())
			->add('address', TextareaType::class, [])
			->add('city', TextType::class, [])
			->add('zipCode', NumberType::class, [])
			->add('status', TextType::class, [])
			->add('mainOwner', OwnerType::class, [])
			->add('mainAnimal', AnimalType::class, [])
			->add('specie', ChoiceType::class, [
				'mapped'                    => false,
				'choice_translation_domain' => true,
				'choices'                   => [
					'entity.customer.specie.cat' => 0,
					'entity.customer.specie.dog' => 1,
				],
			])
			->add('submit', SubmitType::class, [])
			->getForm();

		return $this->render(':customer:new.html.twig', [
			'form' => $form->createView(),
		]);
	}
}