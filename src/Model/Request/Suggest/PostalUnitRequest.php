<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Model\Request\Suggest;

class PostalUnitRequest extends SuggestRequest
{
    /**
     * @var array Фильтрация
     */
    protected $filters;

    /**
     * {@inheritdoc}
     */
    public function getMethodUrl(): string
    {
        return 'postal_unit';
    }
}
