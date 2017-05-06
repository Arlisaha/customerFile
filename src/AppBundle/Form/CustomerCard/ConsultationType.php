<?php

namespace AppBundle\Form\CustomerCard;

use AppBundle\Entity\CustomerCard\Consultation;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConsultationType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		/** @var Consultation $consultation */
		$consultation = $builder->getData();

		$builder
			->add('owners', EntityType::class, [
				'class'         => 'AppBundle\Entity\Customer\Owner',
				'expanded'      => false,
				'multiple'      => true,
				'query_builder' => function (EntityRepository $er) use ($consultation) {
					$qb = $er->createQueryBuilder('o');
					$qb
						->innerJoin('o.customer', 'c')
						->innerJoin('c.customerCard', 'cc')
						->orderBy('o.lastName', 'ASC');

					if ($consultation) {
						$qb->where($qb->expr()->eq('cc.id', $consultation->getCustomerCard()->getId()));
					}

					return $qb;
				},
			])
			->add('animals', EntityType::class, [
				'class'         => 'AppBundle\Entity\Animal\AbstractAnimal',
				'expanded'      => false,
				'multiple'      => true,
				'query_builder' => function (EntityRepository $er) use ($consultation) {
					$qb = $er->createQueryBuilder('a');
					$qb
						->innerJoin('a.customer', 'c')
						->innerJoin('c.customerCard', 'cc')
						->orderBy('a.name', 'ASC');

					if ($consultation) {
						$qb->where($qb->expr()->eq('cc.id', $consultation->getCustomerCard()->getId()));
					}

					return $qb;
				},
			])
			->add('date', DateType::class, [
				'html5'  => true,
				'widget' => 'single_text',
			])
			->add('location', TextType::class, [])
			->add('duration', NumberType::class, [])
			->add('price', NumberType::class, []);
	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
			'data_class' => Consultation::class,
		]);
	}
}
