<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Model\Request\Find;

use Velhron\DadataBundle\Model\Request\Suggest\SuggestRequest;

class AffiliatedPartyRequest extends SuggestRequest
{
    /**
     * @var string[] Ограничение области поиска (FOUNDERS / MANAGERS)
     */
    protected $scope;

    /**
     * {@inheritdoc}
     */
    public function getBaseUrl(): string
    {
        return 'https://suggestions.dadata.ru/suggestions/api/4_1/rs/findAffiliated/';
    }

    /**
     * {@inheritdoc}
     */
    protected function getMethodUrl(): string
    {
        return 'party';
    }
}
