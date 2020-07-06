<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Model\Request\Clean;

class EmailRequest extends CleanRequest
{
    /**
     * {@inheritdoc}
     */
    protected function getMethodUrl(): string
    {
        return 'email';
    }
}