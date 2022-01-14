<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Model\Request\Geolocate;

use Velhron\DadataBundle\Model\Request\Suggest\SuggestRequest;

abstract class GeolocateRequest extends SuggestRequest
{
    /**
     * @var float Географическая широта
     */
    protected $lat;

    /**
     * @var float Географическая долгота
     */
    protected $lon;

    /**
     * @var int Радиус поиска в метрах
     */
    protected $radius_meters;
}
