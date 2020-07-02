<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Model\Request\Suggest;

class FmsUnitRequest extends SuggestRequest
{
    /**
     * @var array Фильтрация
     */
    public $filters;

    /**
     * {@inheritdoc}
     */
    public function getMethodUrl(): string
    {
        return 'fms_unit';
    }
}
