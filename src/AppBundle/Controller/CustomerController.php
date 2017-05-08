<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Animal\AbstractAnimal;
use AppBundle\Entity\Customer\Customer;
use AppBundle\Entity\CustomerCard\CustomerCard;
use AppBundle\Form\Animal\AnimalType;
use AppBundle\Form\Animal\CatType;
use AppBundle\Form\Animal\DogType;
use AppBundle\Form\Customer\OwnerType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
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
		switch ($request->request->get('form')['specie']) {
			case 'dog':
				$type = DogType::class;
				break;
			case 'cat':
				$type = CatType::class;
				break;
			default:
				$type = AnimalType::class;
		}

		$customer = new Customer();
		$form = $this->createFormBuilder($customer)
			->add('address', TextareaType::class, [])
			->add('city', TextType::class, [])
			->add('zipCode', NumberType::class, [])
			->add('status', TextType::class, [])
			->add('mainOwner', OwnerType::class, [])
			->add('mainAnimal', $type, [])
			->add('specie', ChoiceType::class, [
				'mapped'                    => false,
				'choice_translation_domain' => true,
				'choices'                   => [
					'entity.customer.specie.cat' => 'cat',
					'entity.customer.specie.dog' => 'dog',
				],
			])
			->getForm();

		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->get('doctrine.orm.default_entity_manager');

			$em->persist($customer);
			$customerCard = new CustomerCard();
			$customerCard->setCustomer($customer);

			$em->persist($customerCard);
			$em->flush();

			return $this->redirectToRoute('customer_card_edit', ['id' => $customerCard->getId()]);
		}

		return $this->render(':customer:new.html.twig', [
			'form' => $form->createView(),
		]);
	}
}