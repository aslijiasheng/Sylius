<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Sylius\Bundle\AddressingBundle\Form\Type;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Sylius\Bundle\AddressingBundle\Form\Type\CountryType;
use Sylius\Bundle\ResourceBundle\Form\EventSubscriber\AddCodeFormSubscriber;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @mixin CountryType
 *
 * @author Julien Janvier <j.janvier@gmail.com>
 * @author Gonzalo Vilaseca <gvilaseca@reiss.co.uk>
 */
final class CountryTypeSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('Country', ['sylius']);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(CountryType::class);
    }

    function it_is_a_form_type()
    {
        $this->shouldImplement(FormTypeInterface::class);
    }

    function it_has_a_valid_name()
    {
        $this->getName()->shouldReturn('sylius_country');
    }

    function it_builds_form_with_proper_fields(FormBuilder $builder)
    {
        $builder
            ->addEventSubscriber(Argument::type(AddCodeFormSubscriber::class))
            ->shouldBeCalled()
            ->willReturn($builder)
        ;

        $builder
            ->add('provinces', 'collection', Argument::any())
            ->shouldBeCalled()
            ->willReturn($builder)
        ;

        $this->buildForm($builder, []);
    }

    function it_defines_assigned_data_class(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults([
                'data_class' => 'Country',
                'validation_groups' => ['sylius'],
            ])
            ->shouldBeCalled()
        ;

        $this->configureOptions($resolver);
    }
}
