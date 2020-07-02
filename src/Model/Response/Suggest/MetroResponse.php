<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Model\Response\Suggest;

class MetroResponse extends SuggestResponse
{
    /**
     * @var string КЛАДР-код города
     */
    public $cityKladrId;

    /**
     * @var string ФИАС-код города
     */
    public $cityFiasId;

    /**
     * @var string Название города
     */
    public $city;

    /**
     * @var string Название станции
     */
    public $name;

    /**
     * @var string Номер линии
     */
    public $lineId;

    /**
     * @var string Название линии
     */
    public $lineName;

    /**
     * @var string Широта
     */
    public $geoLat;

    /**
     * @var string Долгота
     */
    public $geoLon;

    /**
     * @var string Цвет линии в RGB
     */
    public $color;

    /**
     * @var string Признак закрытия (true, если станция закрыта, false — если открыта)
     */
    public $isClosed;
}
