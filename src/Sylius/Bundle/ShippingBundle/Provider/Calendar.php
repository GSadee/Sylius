<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Sylius Sp. z o.o.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Sylius\Bundle\ShippingBundle\Provider;

trigger_deprecation(
    'sylius/shipping-bundle',
    '1.11',
    'The "Sylius\Bundle\ShippingBundle\Provider\Calendar" class is deprecated and will be removed in 2.0. Use "Sylius\Calendar\Provider\Calendar" instead.',
);

final class Calendar implements DateTimeProvider
{
    public function today(): \DateTimeInterface
    {
        return new \DateTimeImmutable();
    }
}
