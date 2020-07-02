<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Model\Response\Suggest;

class PostalUnitResponse extends SuggestResponse
{
    /**
     * @var string Почтовый индекс
     */
    public $postalCode;

    /**
     * @var string Признак, что отделение закрыто
     */
    public $isClosed;

    /**
     * @var string Тип отделения
     */
    public $typeCode;

    /**
     * @var string Адрес одной строкой
     */
    public $addressStr;

    /**
     * @var string КЛАДР-код населённого пункта
     */
    public $addressKladrId;

    /**
     * @var string Код проверки адреса
     */
    public $addressQc;

    /**
     * @var string Широта
     */
    public $geoLat;

    /**
     * @var string Долгота
     */
    public $geoLon;

    /**
     * @var string Режим работы в понедельник
     */
    public $scheduleMon;

    /**
     * @var string Режим работы во вторник
     */
    public $scheduleTue;

    /**
     * @var string Режим работы в среду
     */
    public $scheduleWed;

    /**
     * @var string Режим работы в четверг
     */
    public $scheduleThu;

    /**
     * @var string Режим работы в пятницу
     */
    public $scheduleFri;

    /**
     * @var string Режим работы в субботу
     */
    public $scheduleSat;

    /**
     * @var string Режим работы в воскресенье
     */
    public $scheduleSun;
}
