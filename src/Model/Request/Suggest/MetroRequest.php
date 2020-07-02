<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Model\Request\Suggest;

class MetroRequest extends SuggestRequest
{
    /**
     * @var array Фильтрация
     *
     * Работает по полям `city_kladr_id`, `city_fias_id`, `city`, `line_id` и `is_closed`.
     */
    public $filters;

    /**
     * {@inheritdoc}
     */
    protected function getMethodUrl(): string
    {
        return 'metro';
    }
}
