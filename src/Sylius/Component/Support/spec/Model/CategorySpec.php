<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Sylius\Component\Support\Model;

use PhpSpec\ObjectBehavior;

/**
 * @author Michał Marcinkowski <michal.marcinkowski@lakion.com>
 * @author Gustavo Perdomo <gperdomor@gmail.com>
 */
class CategorySpec extends ObjectBehavior
{
    public function let()
    {
        $this->setCurrentLocale('en_US');
        $this->setFallbackLocale('en_US');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Sylius\Component\Support\Model\Category');
    }

    function it_implements_Sylius_support_category_interface()
    {
        $this->shouldImplement('Sylius\Component\Support\Model\CategoryInterface');
    }

    function it_has_no_id_by_default()
    {
        $this->getId()->shouldReturn(null);
    }

    function it_has_no_title_by_default()
    {
        $this->getTitle()->shouldReturn(null);
    }

    function its_title_is_mutable()
    {
        $this->setTitle('Title');
        $this->getTitle()->shouldReturn('Title');
    }

    function it_returns_title_when_converted_to_string()
    {
        $this->setTitle('Title');
        $this->__toString()->shouldReturn('Title');
    }
}
