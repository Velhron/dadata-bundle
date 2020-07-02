<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Model\Request\Suggest;

class CountryRequest extends SuggestRequest
{
    /**
     * {@inheritdoc}
     */
    protected function getMethodUrl(): string
    {
        return 'country';
    }
}