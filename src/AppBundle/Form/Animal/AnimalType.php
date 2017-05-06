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
			->add('name', TextType::class, [])
			->add('birthDate', BirthdayType::class, [
				'html5'  => true,
				'widget' => 'single_text',
				'input'  => 'string',
			])
			->add('gender', GenderType::class, [])
			->add('castrated', CheckboxType::class, [])
			->add('weight', NumberType::class, [])
			->add('size', NumberType::class, [])
			->add('temper', TemperType::class, [])
			->add('livingOutside', CheckboxType::class, [])
			->add('outsideTime', TimeType::class, [
				'html5'  => true,
				'widget' => 'single_text',
				'input'  => 'string',
			])
			->add('healthIssues', TextareaType::class, [])
			->add('comment', TextareaType::class, [])
			->add('adoptedFromAssociation', CheckboxType::class, []);
	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
			'data_class' => AbstractAnimal::class,
		]);
	}
}