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

namespace Sylius\Component\Order;

interface SyliusCartEvents
{
    public const CART_CHANGE = 'sylius.cart_change';

    public const CART_ITEM_ADD = 'sylius.cart_item_add';

    public const CART_ITEM_REMOVE = 'sylius.cart_item_remove';

    public const CART_SUMMARY = 'sylius.cart_summary';
}