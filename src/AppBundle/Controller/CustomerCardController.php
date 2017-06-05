<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Animal\AbstractAnimal;
use AppBundle\Entity\Customer\Owner;
use AppBundle\Entity\CustomerCard\Consultation;
use AppBundle\Entity\CustomerCard\CustomerCard;
use AppBundle\Form\Animal\SpecieType;
use AppBundle\Form\CustomerCard\ConsultationType;
use AppBundle\Form\CustomerCard\CustomerCardType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
	 * @return \Symfony\Component\HttpFoundation\Response
	 *
	 * @Route("/all/page/{page}", requirements={"page" = "\d+"}, defaults={"page" = 1}, name="customer_card_all")
	 */
	public function allAction($page)
	{
		$pageElementNumber = $this->getParameter('page_element_number');
		$firstResult = ($page-1)*$pageElementNumber;

		$all = $this
			->get('doctrine.orm.default_entity_manager')
			->getRepository('AppBundle:CustomerCard\CustomerCard')
			->findAllLimit($firstResult, $pageElementNumber);

        if (($all->count() <= $firstResult) && $page !== 1) {
            throw new NotFoundHttpException(sprintf('Requested page does not exists. Max page : %s', $all->count()));
        }
		
		return $this->render(':customer_card:all.html.twig', [
			'customer_cards' => $all,
			'paginator'      => [
	            'page'     => $page,
	            'nb_pages' => ceil(count($all)/$pageElementNumber),
			],
		]);
	}
	
	/**
	 * @param Request $request
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 *
	 * @Route("/search/page/{page}", requirements={"page" = "\d+"}, defaults={"page" = 1}, name="customer_card_search")
	 */
	public function searchAction(Request $request, $page)
	{
		$results           = null;
		$pageElementNumber = $this->getParameter('page_element_number');
		$firstResult       = ($page-1)*$pageElementNumber;
		$form              = $this->createFormBuilder(null)
			->add('owner_lastname', TextType::class, [])
			->add('owner_firstname', TextType::class, [])
			->add('animal_name', TextType::class, [])
			->add('specie', SpecieType::class, [])
			->getForm();
		
		$form->handleRequest($request);
		
		if ($form->isSubmitted() && $form->isValid()) {
			$data    = $form->getData();
			$results = $this
				->get('doctrine.orm.default_entity_manager')
				->getRepository('AppBundle:CustomerCard\CustomerCard')
				->findByOwnerAndAnimal($data['owner_lastname'], $data['owner_firstname'], $data['animal_name'], $data['specie']);
		}
		
		return $this->render(':customer_card:search.html.twig', [
			'form'           => $form->createView(),
			'customer_cards' => $results,
			'paginator'      => [
	            'page'     => $page,
	            'nb_pages' => ceil(count($results)/$pageElementNumber),
			],
		]);
	}
	
	/**
	 * @param Request      $request
	 * @param CustomerCard $customerCard
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 *
	 * @Route("/get/{id}", requirements={"id" = "\d+"}, name="customer_card_get")
	 * @ParamConverter("customerCard", class="AppBundle:CustomerCard\CustomerCard")
	 */
	public function getAction(Request $request, CustomerCard $customerCard)
	{
		$consultation = new Consultation();
		$form         = $this->createForm(ConsultationType::class, $consultation, [
			'customer_card_id' => $customerCard->getId(),
		]);
		
		$form->handleRequest($request);
		
		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->get('doctrine.orm.default_entity_manager');
			
			$consultation->setCustomerCard($customerCard);
			$em->persist($consultation);
			
			$em->flush();
			
			$this->redirectToRoute('customer_card_get', ['id' => $customerCard->getId()]);
		}
		
		return $this->render(':customer_card:get.html.twig', [
			'customer_card' => $customerCard,
			'form'          => $form->createView(),
		]);
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
		$form = $this->createForm(CustomerCardType::class, $customerCard, [
			'action' => $this->generateUrl('customer_card_edit', ['id' => $customerCard->getId()]),
			'method' => 'POST',
		]);
		
		$form->handleRequest($request);
		
		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->get('doctrine.orm.default_entity_manager');
			
			$em->persist($customerCard);
			$customer = $customerCard->getCustomer();
			
			/** @var Consultation[] $consultations */
			$consultations = $customerCard->getConsultations();
			foreach ($consultations as $consultation) {
				$consultation->setCustomerCard($customerCard);
				$em->persist($consultation);
			}
			
			/** @var Owner[] $owners */
			$owners = $customer->getOwners();
			foreach ($owners as $owner) {
				$owner->setCustomer($customer);
				$em->persist($owner);
			}
			
			/** @var AbstractAnimal[] $animals */
			$animals = $customer->getAnimals();
			foreach ($animals as $animal) {
				$animal->setCustomer($customer);
				$em->persist($animal);
			}
			
			$em->flush();
			
			return $this->redirectToRoute('customer_card_get', ['id' => $customerCard->getId()]);
		}
		
		return $this->render(':customer_card:edit.html.twig', [
			'form' => $form->createView(),
		]);
	}
}
