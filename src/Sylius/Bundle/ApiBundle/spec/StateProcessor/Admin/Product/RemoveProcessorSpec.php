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

namespace spec\Sylius\Bundle\ApiBundle\StateProcessor\Admin\Product;

use ApiPlatform\Metadata\DeleteOperationInterface;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException;
use PhpSpec\ObjectBehavior;
use Sylius\Bundle\ApiBundle\Exception\ProductCannotBeRemoved;
use Sylius\Component\Core\Model\ProductInterface;

final class RemoveProcessorSpec extends ObjectBehavior
{
    function let(ProcessorInterface $removeProcessor): void
    {
        $this->beConstructedWith($removeProcessor);
    }

    function it_is_a_processor_interface(): void
    {
        $this->shouldImplement(ProcessorInterface::class);
    }

    public function it_processes_remove_operation(
        ProcessorInterface $removeProcessor,
        Operation $operation,
        ProductInterface $product,
    ) {
        $operation->implement(DeleteOperationInterface::class);
        $removeProcessor->process($product, $operation, [], [])->willReturn(null);

        $this->process($product, $operation, [], [])->shouldReturn(null);
    }

    public function it_throws_exception_when_foreign_key_constraint_violation_occurs(
        ProcessorInterface $removeProcessor,
        Operation $operation,
        ProductInterface $product,
    ) {
        $operation->implement(DeleteOperationInterface::class);
        $removeProcessor->process($product, $operation, [], [])->willThrow(ForeignKeyConstraintViolationException::class);

        $this->shouldThrow(ProductCannotBeRemoved::class)->during('process', [$product, $operation, [], []]);
    }

    public function it_throws_exception_if_operation_is_not_delete(
        Operation $operation,
        ProductInterface $product,
    ) {
        $this->shouldThrow(\InvalidArgumentException::class)->during('process', [$product, $operation, [], []]);
    }

    public function it_throws_exception_if_data_is_not_product_interface(
        Operation $operation,
        \stdClass $nonProduct,
    ) {
        $this->shouldThrow(\InvalidArgumentException::class)->during('process', [$nonProduct, $operation, [], []]);
    }
}