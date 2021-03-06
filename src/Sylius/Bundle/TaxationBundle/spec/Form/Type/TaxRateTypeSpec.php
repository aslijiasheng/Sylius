<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Sylius\Bundle\TaxationBundle\Form\Type;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Sylius\Bundle\ResourceBundle\Form\EventSubscriber\AddCodeFormSubscriber;
use Sylius\Bundle\TaxationBundle\Form\Type\TaxRateType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @mixin TaxRateType
 *
 * @author Julien Janvier <j.janvier@gmail.com>
 */
final class TaxRateTypeSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('TaxCategory', ['sylius']);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(TaxRateType::class);
    }

    function it_is_a_form_type()
    {
        $this->shouldImplement(FormTypeInterface::class);
    }

    function it_has_a_valid_name()
    {
        $this->getName()->shouldReturn('sylius_tax_rate');
    }

    function it_builds_form_with_proper_fields(FormBuilder $builder)
    {
        $builder
            ->add('category', 'sylius_tax_category_choice', Argument::any())
            ->willReturn($builder)
        ;

        $builder
            ->add('name', 'text', Argument::any())
            ->willReturn($builder)
        ;

        $builder
            ->add('amount', 'percent', Argument::any())
            ->willReturn($builder)
        ;

        $builder
            ->add('includedInPrice', 'checkbox', Argument::any())
            ->willReturn($builder)
        ;

        $builder
            ->add('calculator', 'sylius_tax_calculator_choice', Argument::any())
            ->willReturn($builder)
        ;

        $builder
            ->addEventSubscriber(Argument::type(AddCodeFormSubscriber::class))
            ->willReturn($builder)
        ;

        $this->buildForm($builder, []);
    }

    function it_defines_assigned_data_class(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults(
                [
                    'data_class' => 'TaxCategory',
                    'validation_groups' => ['sylius'],
                ]
            )
            ->shouldBeCalled();

        $this->configureOptions($resolver);
    }
}
