<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Model\Request\Iplocate;

use Velhron\DadataBundle\Model\Request\Suggest\SuggestRequest;

class AddressRequest extends SuggestRequest
{
    /**
     * {@inheritdoc}
     */
    public function getBaseUrl(): string
    {
        return 'https://suggestions.dadata.ru/suggestions/api/4_1/rs/iplocate/';
    }

    /**
     * {@inheritdoc}
     */
    public function getMethodUrl(): string
    {
        return 'address';
    }
}
