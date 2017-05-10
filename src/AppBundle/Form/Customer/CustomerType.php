<?php

namespace AppBundle\Form\Customer;

use AppBundle\Entity\Customer\Customer;
use AppBundle\Form\Animal\CatType;
use AppBundle\Form\Animal\DogType;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CustomerType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('dogs', CollectionType::class, [
				'entry_type'     => DogType::class,
				'allow_add'      => true,
				'allow_delete'   => true,
				'prototype'      => true,
				'prototype_name' => '__dog__',
				'by_reference'   => false,
				'required'       => false,
			
			])
			->add('owners', CollectionType::class, [
				'entry_type'     => OwnerType::class,
				'allow_add'      => true,
				'allow_delete'   => true,
				'prototype'      => true,
				'prototype_name' => '__owner__',
				'by_reference'   => false,
				'required'       => false,
			])
			->add('address', TextareaType::class, [
				'required' => true,
			])
			->add('city', TextType::class, [
				'required' => true,
			])
			->add('zipCode', TextType::class, [
				'required' => true,
			])
			->add('status', TextType::class, [
				'required' => false,
			]);
		
		$builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
			/** @var Customer $customer */
			$customer = $event->getData();
			$form     = $event->getForm();dump($customer->getCats());die;
			
			$form
				->add('mainOwner', EntityType::class, [
					'class'         => 'AppBundle\Entity\Customer\Owner',
					'expanded'      => false,
					'multiple'      => false,
					'required'      => true,
					'query_builder' => function (EntityRepository $er) use ($customer) {
						$qb = $er->createQueryBuilder('o');
						$qb->andWhere($qb->expr()->eq('o.customer', $customer->getId()))
							->orderBy('o.lastName', 'ASC');
						
						return $qb;
					},
				])
				->add('mainAnimal', EntityType::class, [
					'class'         => 'AppBundle\Entity\Animal\AbstractAnimal',
					'expanded'      => false,
					'multiple'      => false,
					'required'      => true,
					'query_builder' => function (EntityRepository $er) use ($customer) {
						$qb = $er->createQueryBuilder('a');
						$qb->andWhere($qb->expr()->eq('a.customer', $customer->getId()))
							->orderBy('a.name', 'ASC');
						
						return $qb;
					},
				])
				->add('cats', CollectionType::class, [
					'entry_type'     => CatType::class,
					'allow_add'      => true,
					'allow_delete'   => true,
					'prototype'      => true,
					'prototype_name' => '__cat__',
					'by_reference'   => false,
					'required'       => false,
					'data' => $customer->getCats(),
				]);
		});
	}
	
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
			'data_class' => Customer::class,
		]);
	}
	
	public function getName()
	{
		return 'customer';
	}
}
