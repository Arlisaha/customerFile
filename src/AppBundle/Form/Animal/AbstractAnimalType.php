<?php

namespace AppBundle\Form\Animal;

use AppBundle\Entity\Animal\AbstractAnimal;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class AbstractAnimalType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('id', HiddenType::class, [])
			->add('name', TextType::class, [])
			->add('ageValue', IntegerType::class, [])
			->add('ageUnit', AgeUnitType::class, [])
			->add('gender', GenderType::class, [])
			->add('castrated', CheckboxType::class, [])
			->add('weight', NumberType::class, [])
			->add('size', NumberType::class, [])
			->add('temper', EntityType::class, [
				'class'         => 'AppBundle\Entity\Animal\Temper',
				'expanded'      => true,
				'multiple'      => true,
				'query_builder' => function (EntityRepository $er) {
					return $er->createQueryBuilder('t')
						->orderBy('t.label', 'ASC');
				},
			])
			->add('livingOutside', CheckboxType::class, [])
			->add('outsideTime', NumberType::class, [])
			->add('outsideTimeUnit', OutsideTimeUnitType::class, [])
			->add('healthIssues', TextareaType::class, [])
			->add('comment', TextareaType::class, [])
			->add('customer', EntityType::class, [
				'class'    => 'AppBundle\Entity\Customer\Customer',
				'expanded' => false,
				'multiple' => false,
				'query_builder' => function (EntityRepository $er) {
					return $er->createQueryBuilder('c')
						->innerJoin('c.mainAnimal', 'ma')
						->orderBy('ma.name', 'ASC');
				},
			])
			->add('adoptedFromAssociation', CheckboxType::class, []);
	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
			'data_class' => AbstractAnimal::class,
		]);
	}
}