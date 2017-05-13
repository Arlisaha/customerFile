<?php

namespace AppBundle\Form\CustomerCard;

use AppBundle\Entity\CustomerCard\Consultation;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConsultationType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('id', HiddenType::class, [])
			->add('date', DateType::class, [
				'html5'    => true,
				'widget'   => 'single_text',
				'required' => true,
			])
			->add('location', TextType::class, [
				'required' => false,
			])
			->add('duration', TimeType::class, [
				'html5'    => true,
				'widget'   => 'single_text',
				'required' => false,
			])
			->add('price', MoneyType::class, [
				'required' => false,
			])
			->add('purposes', TextareaType::class, [
				'required' => false,
			])
			->add('type', ConsultationTypeType::class, []);
		
		$builder->addEventListener(
			FormEvents::PRE_SET_DATA,
			function (FormEvent $event) use ($options) {
				/** @var Consultation $consultation */
				$form           = $event->getForm();
				$customerCardId = $options['customer_card_id'];
				
				$form
					->add('owners', EntityType::class, [
						'class'         => 'AppBundle\Entity\Customer\Owner',
						'expanded'      => false,
						'multiple'      => true,
						'required'      => false,
						'query_builder' => function (EntityRepository $er) use ($customerCardId) {
							$qb = $er->createQueryBuilder('o');
							$qb
								->innerJoin('o.customer', 'c')
								->andWhere($qb->expr()->eq('c.customerCard', $customerCardId))
								->orderBy('o.lastName', 'ASC');
							
							return $qb;
						},
					])
					->add('animals', EntityType::class, [
						'class'         => 'AppBundle\Entity\Animal\AbstractAnimal',
						'expanded'      => false,
						'multiple'      => true,
						'required'      => false,
						'query_builder' => function (EntityRepository $er) use ($customerCardId) {
							$qb = $er->createQueryBuilder('a');
							$qb
								->innerJoin('a.customer', 'c')
								->andWhere($qb->expr()->eq('c.customerCard', $customerCardId))
								->orderBy('a.name', 'ASC');
							
							return $qb;
						},
					]);
			});
	}
	
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver
			->setDefaults([
				'data_class'       => Consultation::class,
				'customer_card_id' => null,
			])
			->setRequired('customer_card_id');
	}
	
	public function getName()
	{
		return 'consultation';
	}
}
