<?php

namespace AppBundle\Form\Customer;

use AppBundle\Entity\Customer\Customer;
use AppBundle\Form\Animal\AbstractAnimalType;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CustomerType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('animals', CollectionType::class, [
				'entry_type'   => AbstractAnimalType::class,
				'allow_add'    => true,
				'allow_delete' => true,
			])
			->add('owners', CollectionType::class, [
				'entry_type'   => OwnerType::class,
				'allow_add'    => true,
				'allow_delete' => true,
			])
			->add('mainAnimal', EntityType::class, [
				'class'         => 'AppBundle\Entity\Animal\AbstractAnimal',
				'expanded'      => false,
				'multiple'      => false,
				'query_builder' => function (EntityRepository $er) {
					return $er->createQueryBuilder('aa')
						->orderBy('aa.name', 'ASC');
				},
			])
			->add('mainOwner', EntityType::class, [
				'class'         => 'AppBundle\Entity\Customer\Owner',
				'expanded'      => false,
				'multiple'      => false,
				'query_builder' => function (EntityRepository $er) {
					return $er->createQueryBuilder('o')
						->orderBy('o.lastName', 'ASC');
				},
			])
			->add('address', TextType::class, [])
			->add('city', TextType::class, [])
			->add('zipCode', NumberType::class, [])
			->add('status', TextType::class, []);
	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
			'data_class' => Customer::class,
		]);
	}
}
