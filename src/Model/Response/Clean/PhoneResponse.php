<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Model\Response\Clean;

class PhoneResponse extends CleanResponse
{
    /**
     * @var string Тип телефона
     */
    public $type;

    /**
     * @var string Стандартизованный телефон одной строкой
     */
    public $phone;

    /**
     * @var string Код страны
     */
    public $countryCode;

    /**
     * @var string Код города / DEF-код
     */
    public $cityCode;

    /**
     * @var string Локальный номер телефона
     */
    public $number;

    /**
     * @var string Добавочный номер
     */
    public $extension;

    /**
     * @var string Оператор связи (только для России)
     */
    public $provider;

    /**
     * @var string Страна
     */
    public $country;

    /**
     * @var string Регион (только для России)
     */
    public $region;

    /**
     * @var string Город (только для стационарных телефонов)
     */
    public $city;

    /**
     * @var string часовой пояс города для России, часовой пояс страны — для иностранных телефонов
     *
     * Если у страны несколько поясов, вернёт минимальный и максимальный через слеш: UTC+5/UTC+6
     */
    public $timezone;

    /**
     * @var int Признак конфликта телефона с адресом
     *
     * 0 - Телефон соответствует адресу
     * 2 - Города адреса и телефона отличаются
     * 3 - Регионы адреса и телефона отличаются
     */
    public $qcConflict;
}
