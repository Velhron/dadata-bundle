<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Model\Request\Geolocate;

class AddressRequest extends GeolocateRequest
{
    /**
     * @var int Радиус поиска в метрах (максимум – 1000)
     */
    protected $radius_meters;

    /**
     * @var string На каком языке вернуть результат (ru / en)
     */
    protected $language;

    /**
     * {@inheritdoc}
     */
    public function getMethodUrl(): string
    {
        return 'address';
    }
}
