<?php

/*
 * This file is part of the Lakion package.
 *
 * (c) Lakion
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
 
namespace Sylius\Component\Support\Adapter;

/**
 * @author Grzegorz Sadowski <grzegorz.sadowski@lakion.com>
 */
class ConfigNotificationRecipientAdapter implements ConfigNotificationRecipientAdapterInterface
{
    /**
     * @var array
     */
    private $emails;

    /**
     * @param array $emails
     */
    public function __construct(array $emails)
    {
        $this->emails = $emails;
    }

    /**
     * {@inheritdoc}
     */
    public function getEmails()
    {
        return $this->emails;
    }
}
