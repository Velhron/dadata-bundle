<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Model\Request\Suggest;

class CurrencyRequest extends SuggestRequest
{
    /**
     * {@inheritdoc}
     */
    protected function getMethodUrl(): string
    {
        return 'currency';
    }
}
