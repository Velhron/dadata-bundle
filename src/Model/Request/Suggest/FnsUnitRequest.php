<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Model\Request\Suggest;

class FnsUnitRequest extends SuggestRequest
{
    /**
     * @var array Фильтрация
     */
    public $filters;

    /**
     * {@inheritdoc}
     */
    protected function getMethodUrl(): string
    {
        return 'fns_unit';
    }
}
