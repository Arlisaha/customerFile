<?php

namespace AppBundle\Form\Customer;

use AppBundle\Entity\Customer\Owner;
use AppBundle\Form\Owner\GenderType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OwnerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
		$builder
			->add('lifeStyle', LifeStyleType::class, [])
			->add('gender', GenderType::class, [])
			->add('comment', TextareaType::class, [])
			->add('job', TextType::class, [])
			->add('birthDate', DateType::class, [])
			->add('firstName', TextType::class, [])
			->add('lastName', TextType::class, [])
			->add('email', EmailType::class, [])
			->add('phone', NumberType::class, []);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
		$resolver->setDefaults([
			'data_class' => Owner::class,
		]);
    }
}
