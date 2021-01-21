<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Model\Request\Suggest;

class PartyRequest extends SuggestRequest
{
    /**
     * @var array Ограничение по статусу организации
     */
    protected $status;

    /**
     * @var string Ограничение по типу организации (LEGAL / INDIVIDUAL)
     */
    protected $type;

    /**
     * @var array Ограничение по региону или городу
     */
    protected $locations;

    /**
     * @var array Приоритет города при ранжировании
     */
    protected $locations_boost;

    /**
     * @var array Ограничение по коду ОКВЭД
     */
    protected $okved;
}
