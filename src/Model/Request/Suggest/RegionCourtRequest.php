<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Model\Request\Suggest;

class RegionCourtRequest extends SuggestRequest
{
    /**
     * @var array Фильтрация
     *
     * Работает по полю `region_code` (первые 2 цифры КЛАДР-кода региона).
     */
    protected $filters;

    /**
     * {@inheritdoc}
     */
    protected function getMethodUrl(): string
    {
        return 'region_court';
    }
}
