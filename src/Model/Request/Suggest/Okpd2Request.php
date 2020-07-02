<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Model\Request\Suggest;

class Okpd2Request extends SuggestRequest
{
    /**
     * @var array Фильтрация
     *
     * Работает по полю `razdel`.
     */
    public $filters;

    /**
     * {@inheritdoc}
     */
    protected function getMethodUrl(): string
    {
        return 'okpd2';
    }
}
