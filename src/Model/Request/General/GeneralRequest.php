<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Model\Request\General;

use Velhron\DadataBundle\Model\Request\AbstractRequest;

abstract class GeneralRequest extends AbstractRequest
{
    /**
     * {@inheritdoc}
     */
    public function getMethod(): string
    {
        return 'GET';
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

    /**
     * {@inheritdoc}
     */
    protected function getBaseUrl(): string
    {
        return 'https://dadata.ru/api/v2/';
    }
}
