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
}
