<?php

namespace AppBundle\Form\Animal;

use AppBundle\Entity\Animal\AbstractAnimal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnimalType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('id', HiddenType::class, [])
			->add('name', TextType::class, [
				'required' => true,
			])
			->add('birthDate', BirthdayType::class, [
				'html5'    => true,
				'widget'   => 'single_text',
				'input'    => 'string',
				'required' => false,
			])
			->add('gender', GenderType::class, [
				'required' => true,
			])
			->add('castrated', CheckboxType::class, [
				'required' => false,
			])
			->add('weight', NumberType::class, [
				'required' => false,
			])
			->add('size', NumberType::class, [
				'required' => false,
			])
			->add('temper', TemperType::class, [
				'required' => false,
			])
			->add('livingOutside', CheckboxType::class, [
				'required' => false,
			])
			->add('outsideTime', TimeType::class, [
				'html5'    => true,
				'widget'   => 'single_text',
				'input'    => 'string',
				'required' => false,
			])
			->add('healthIssues', TextareaType::class, [
				'required' => false,
			])
			->add('comment', TextareaType::class, [
				'required' => false,
			])
			->add('adoptedFromAssociation', CheckboxType::class, [
				'required' => false,
			]);
	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
			'data_class' => AbstractAnimal::class,
		]);
	}
}