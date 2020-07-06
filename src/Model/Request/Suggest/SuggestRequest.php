<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Model\Request\Suggest;

use Velhron\DadataBundle\Model\Request\AbstractRequest;

abstract class SuggestRequest extends AbstractRequest
{
    /**
     * @var int Количество подсказок (результатов)
     */
    protected $count;

    /**
     * {@inheritdoc}
     */
    public function getBaseUrl(): string
    {
        return 'https://suggestions.dadata.ru/suggestions/api/4_1/rs/suggest/';
    }

    /**
     * {@inheritdoc}
     */
    public function getBody(): array
    {
        return array_filter(get_object_vars($this), function ($var) {
            return null !== $var;
        });
    }
}
