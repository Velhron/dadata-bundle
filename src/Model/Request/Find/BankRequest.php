<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Model\Request\Find;

class BankRequest extends FindRequest
{
    /**
     * {@inheritdoc}
     */
    protected function getMethodUrl(): string
    {
        return 'bank';
    }
}
