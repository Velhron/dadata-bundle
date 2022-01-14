<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Model\Request\Suggest;

class FiasRequest extends SuggestRequest
{
    /**
     * @var array Ограничение области поиска
     */
    protected $locations;

    /**
     * @var array Приоритет города при ранжировании
     */
    protected $locations_boost;

    /**
     * @var array Гранулярные подсказки по ФИАС
     */
    protected $from_bound;

    /**
     * @var array Гранулярные подсказки по ФИАС
     */
    protected $to_bound;
}
