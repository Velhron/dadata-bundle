<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Model\Request\Clean;

class PassportRequest extends CleanRequest
{
    /**
     * {@inheritdoc}
     */
    public function getMethodUrl(): string
    {
        return 'passport';
    }
}
