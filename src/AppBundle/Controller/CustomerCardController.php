<?php

namespace AppBundle\Controller;

use AppBundle\Entity\CustomerCard\CustomerCard;
use AppBundle\Form\CustomerCard\CustomerCardType;
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
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
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
	 * @param Request $request
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 *
	 * @Route("/new", name="customer_card_new")
	 */
    public function newAction(Request $request)
	{
		$customerCard = new CustomerCard();

		$form = $this->createForm(CustomerCardType::class, $customerCard, []);

		$form->handleRequest($request);

		if($form->isSubmitted() && $form->isValid()) {

		}

		return $this->render(':customer_card:new.html.twig', [
			'form' => $form->createView(),
		]);
	}

	/**
	 * @param Request $request
	 * @param         $id
	 *
	 * @Route("/get/{id}", requirements={"id" = "\d+"}, name="customer_card_get")
	 */
	public function getAction(Request $request, $id)
	{

	}

	/**
	 * @param Request $request
	 * @param         $id
	 *
	 * @Route("/edit/{id}", requirements={"id" = "\d+"}, name="customer_card_edit")
	 */
	public function editAction(Request $request, $id)
	{

	}
}
