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

namespace Sylius\Bundle\ProductBundle\Form\Type;

use Sylius\Bundle\ResourceBundle\Form\DataTransformer\ResourceToIdentifierTransformer;
use Sylius\Component\Product\Model\ProductInterface;
use Sylius\Resource\Doctrine\Persistence\RepositoryInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\ReversedTransformer;

final class ProductCodeChoiceType extends AbstractType
{
    /** @param RepositoryInterface<ProductInterface> $productRepository */
    public function __construct(private RepositoryInterface $productRepository)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->addModelTransformer(
            new ReversedTransformer(new ResourceToIdentifierTransformer($this->productRepository, 'code')),
        );
    }

    public function getParent(): string
    {
        return ProductChoiceType::class;
    }

    public function getBlockPrefix(): string
    {
        return 'sylius_product_code_choice';
    }
}