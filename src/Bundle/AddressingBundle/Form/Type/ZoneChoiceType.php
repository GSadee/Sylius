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

namespace Sylius\Bundle\AddressingBundle\Form\Type;

use Sylius\Component\Addressing\Model\Scope as AddressingScope;
use Sylius\Component\Addressing\Model\ZoneInterface;
use Sylius\Resource\Doctrine\Persistence\RepositoryInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Webmozart\Assert\Assert;

final class ZoneChoiceType extends AbstractType
{
    /**
     * @param RepositoryInterface<ZoneInterface> $zoneRepository
     * @param array<string, mixed> $scopeTypes
     */
    public function __construct(
        private readonly RepositoryInterface $zoneRepository,
        private readonly array $scopeTypes,
    ) {
        Assert::notEmpty($this->scopeTypes, 'There should be at least one scope type.');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'choices' => function (Options $options): iterable {
                $zoneCriteria = [];
                if ($options['zone_scope'] !== AddressingScope::ALL) {
                    $zoneCriteria['scope'] = [$options['zone_scope'], AddressingScope::ALL];
                }

                return $this->zoneRepository->findBy($zoneCriteria);
            },
            'choice_value' => 'code',
            'choice_label' => 'name',
            'choice_translation_domain' => false,
            'label' => 'sylius.form.address.zone',
            'placeholder' => 'sylius.form.zone.select',
            'zone_scope' => AddressingScope::ALL,
        ]);

        $resolver->setAllowedValues('zone_scope', array_keys($this->scopeTypes));
    }

    public function getParent(): string
    {
        return ChoiceType::class;
    }

    public function getBlockPrefix(): string
    {
        return 'sylius_zone_choice';
    }
}