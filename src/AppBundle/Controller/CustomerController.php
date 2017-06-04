<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Customer\Customer;
use AppBundle\Entity\CustomerCard\CustomerCard;
use AppBundle\Form\Animal\AnimalType;
use AppBundle\Form\Animal\CatType;
use AppBundle\Form\Animal\DogType;
use AppBundle\Form\Animal\SpecieType;
use AppBundle\Form\Customer\OwnerType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
			->add('mainOwner', OwnerType::class, [])
			->add('mainAnimal', $type, [])
			->add('specie', SpecieType::class, [])
			->getForm();

		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$customerCard = new CustomerCard();
			$em = $this->get('doctrine.orm.default_entity_manager');

			$em->persist($customer);
			$animal = $customer->getMainAnimal()->setCustomer($customer);
			$em->persist($animal);
			$owner = $customer->getMainOwner()->setCustomer($customer);
			$em->persist($owner);
			$customerCard->setCustomer($customer);
			$em->persist($customerCard);
			$customer->setCustomerCard($customerCard);
			$customer->addAnimal($animal)->addOwner($owner);
			$em->persist($customer);

			$em->flush();

			return $this->redirectToRoute('customer_card_edit', ['id' => $customerCard->getId()]);
		}

		return $this->render(':customer:new.html.twig', [
			'form' => $form->createView(),
		]);
	}
}