<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Model\Request\Find;

use Velhron\DadataBundle\Model\Request\Suggest\SuggestRequest;

abstract class FindRequest extends SuggestRequest
{
    /**
     * {@inheritdoc}
     */
    public function getBaseUrl(): string
    {
        return 'https://suggestions.dadata.ru/suggestions/api/4_1/rs/findById/';
    }
}
