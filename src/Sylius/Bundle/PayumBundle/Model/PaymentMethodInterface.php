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

namespace Sylius\Bundle\PayumBundle\Model;

use Payum\Core\Model\GatewayConfigInterface;
use Sylius\Component\Payment\Model\PaymentMethodInterface as BasePaymentMethodInterface;

interface PaymentMethodInterface extends BasePaymentMethodInterface
{
    public function setGatewayConfig(?GatewayConfigInterface $gateway): void;

    public function getGatewayConfig(): ?GatewayConfigInterface;
}
