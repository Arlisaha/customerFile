<?php

namespace AppBundle\Controller;

use AppBundle\Entity\CustomerCard\CustomerCard;
use AppBundle\Form\CustomerCard\CustomerCardType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class CustomerCardController
 * @package AppBundle\Controller
 *
 * @Route("/customer_card")
 */
class CustomerCardController extends Controller
{
	/**
	 * @param $name
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 *
	 * @Route("/", name="customer_card")
	 */
	public function indexAction()
	{
		$form = $this->createForm(CustomerCardType::class, null, []);

		return $this->render(':customer_card:edit.html.twig', [
			'form' => $form->createView(),
		]);
	}

	/**
	 * @param Request $request
	 *
	 * @Route("/all", name="customer_card_all")
	 */
	public function allAction(Request $request)
	{

	}

	/**
	 * @param Request $request
	 *
	 * @Route("/list", name="customer_card_list")
	 */
	public function listAction(Request $request)
	{

	}

	/**
	 * @param Request      $request
	 * @param CustomerCard $customerCard
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 *
	 * @Route("/get/{id}", requirements={"id" = "\d+"}, name="customer_card_get")
	 * @ParamConverter("customerCard", class="AppBundle\Entity\CustomerCard\CustomerCard")
	 */
	public function getAction(Request $request, CustomerCard $customerCard)
	{
	}

	/**
	 * @param Request      $request
	 * @param CustomerCard $customerCard
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 *
	 * @Route("/edit/{id}", requirements={"id" = "\d+"}, name="customer_card_edit")
	 * @ParamConverter("customerCard", class="AppBundle:CustomerCard\CustomerCard")
	 */
	public function editAction(Request $request, CustomerCard $customerCard)
	{
		$form = $this->createForm(CustomerCardType::class, $customerCard, []);

		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {

		}

		return $this->render(':customer_card:edit.html.twig', [
			'form' => $form->createView(),
		]);
	}
}
