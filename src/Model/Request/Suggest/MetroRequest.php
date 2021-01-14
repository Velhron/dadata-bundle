<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Model\Request\Suggest;

class MetroRequest extends SuggestRequest
{
    /**
     * @var array Фильтрация
     */
    public $filters;
}
