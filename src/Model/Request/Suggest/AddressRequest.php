<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Model\Request\Suggest;

class AddressRequest extends SuggestRequest
{
    /**
     * @var string На каком языке вернуть результат (ru / en)
     */
    protected $language;

    /**
     * @var array Ограничение области поиска
     */
    protected $locations;

    /**
     * @var array Ограничение по радиусу окружности
     */
    protected $locations_geo;

    /**
     * @var array Приоритет города при ранжировании
     */
    protected $locations_boost;

    /**
     * @var array Гранулярные подсказки по адресу
     */
    protected $from_bound;

    /**
     * @var array Гранулярные подсказки по адресу
     */
    protected $to_bound;
}
