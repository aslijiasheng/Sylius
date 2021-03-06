<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Sylius\Bundle\ShippingBundle\Form\Type;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Sylius\Bundle\ShippingBundle\Form\Type\ShipmentType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Test\FormBuilderInterface;

/**
 * @mixin ShipmentType
 *
 * @author Arnaud Langlade <arn0d.dev@gamil.com>
 */
final class ShipmentTypeSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('Shipment', ['sylius']);
    }

    function it_is_a_form()
    {
        $this->shouldHaveType(AbstractType::class);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ShipmentType::class);
    }

    function it_builds_a_form(FormBuilderInterface $builder)
    {
        $builder->add('state', 'choice', Argument::withKey('choices'))->shouldBeCalled()->willreturn($builder);
        $builder->add('tracking', 'text', Argument::type('array'))->shouldBeCalled()->willreturn($builder);

        $this->buildForm($builder, [
            'multiple' => true,
        ]);
    }

    function it_has_a_name()
    {
        $this->getName()->shouldReturn('sylius_shipment');
    }
}
