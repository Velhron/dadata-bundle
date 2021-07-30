<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Traits;

trait Phone
{
    /**
     * @var string телефон одной строкой как в ЕГРЮЛ
     */
    public $source;

    /**
     * @var string тип телефона (мобильный, стационарный, ...)
     */
    public $type;

    /**
     * @var string код страны
     */
    public $countryCode;

    /**
     * @var string код города / DEF-код
     */
    public $cityCode;

    /**
     * @var string локальный номер телефона
     */
    public $number;

    /**
     * @var string оператор связи
     */
    public $provider;

    /**
     * @var string регион
     */
    public $region;

    /**
     * @var string город (только для стационарных телефонов)
     */
    public $city;

    /**
     * @var string часовой пояс
     */
    public $timezone;

    /**
     * @var string контактное лицо
     */
    public $contact;
}
