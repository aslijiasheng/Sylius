<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Sylius\Component\Core\Model;

use PhpSpec\ObjectBehavior;
use Sylius\Component\Core\Model\ProductTranslation;
use Sylius\Component\Core\Model\ProductTranslationInterface;
use Sylius\Component\Product\Model\ProductTranslation as BaseProductTranslation;

/**
 * @mixin ProductTranslation
 *
 * @author Gonzalo Vilaseca <gvilaseca@reiss.co.uk>
 */
final class ProductTranslationSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ProductTranslation::class);
    }

    function it_implements_a_core_product_interface()
    {
        $this->shouldImplement(ProductTranslationInterface::class);
    }

    function it_extends_a_product_translation_model()
    {
        $this->shouldHaveType(BaseProductTranslation::class);
    }

    function it_does_not_have_a_short_description_by_default()
    {
        $this->getShortDescription()->shouldReturn(null);
    }

    function its_short_description_is_mutable()
    {
        $this->setShortDescription('Amazing product...');
        $this->getShortDescription()->shouldReturn('Amazing product...');
    }
}
