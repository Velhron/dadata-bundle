<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Model\Request\Geolocate;

class PostalUnitRequest extends GeolocateRequest
{
    /**
     * @var int Радиус поиска в метрах (максимум – 1000)
     */
    protected $radius_meters;

    /**
     * {@inheritdoc}
     */
    protected function getMethodUrl(): string
    {
        return 'postal_unit';
    }
}
