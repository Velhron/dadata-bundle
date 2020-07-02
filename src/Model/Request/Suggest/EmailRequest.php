<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Model\Request\Suggest;

class EmailRequest extends SuggestRequest
{
    /**
     * {@inheritdoc}
     */
    public function getMethodUrl(): string
    {
        return 'email';
    }
}
