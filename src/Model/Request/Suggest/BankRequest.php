<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Model\Request\Suggest;

class BankRequest extends SuggestRequest
{
    /**
     * @var array Ограничение по статусу банка
     */
    protected $status;

    /**
     * @var array Ограничение по типу банка
     *
     * Доступные типы:
     * BANK        - Банк
     * NKO         - Небанковская кредитная организация
     * BANK_BRANCH - Филиал банка
     * NKO_BRANCH  - Филиал небанковской кредитной организации
     * RKC         - РКЦ / ГРКЦ
     * OTHER       - Другое
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
}
