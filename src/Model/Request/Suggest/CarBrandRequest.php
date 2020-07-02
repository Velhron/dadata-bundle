<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Model\Request\Suggest;

class CarBrandRequest extends SuggestRequest
{
    /**
     * {@inheritdoc}
     */
    protected function getMethodUrl(): string
    {
        return 'car_brand';
    }
}
