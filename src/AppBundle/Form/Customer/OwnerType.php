<?php

namespace AppBundle\Form\Customer;

use AppBundle\Entity\Customer\Owner;
use AppBundle\Form\FormType\TelType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OwnerType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('id', HiddenType::class, [])
			->add('lifeStyle', LifeStyleType::class, [
				'required' => false,
			])
			->add('gender', GenderType::class, [
				'required' => true,
			])
			->add('comment', TextareaType::class, [
				'required' => false,
			])
			->add('job', TextType::class, [
				'required' => false,
			])
			->add('birthDate', DateType::class, [
				'html5'    => true,
				'widget'   => 'single_text',
				'required' => false,
			])
			->add('firstName', TextType::class, [
				'required' => true,
			])
			->add('lastName', TextType::class, [
				'required' => true,
			])
			->add('email', EmailType::class, [
				'required' => true,
			])
			->add('phone', TelType::class, [
				'required' => true,
			]);
	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
			'data_class' => Owner::class,
		]);
	}

	public function getName()
	{
		return 'owner';
	}
}
