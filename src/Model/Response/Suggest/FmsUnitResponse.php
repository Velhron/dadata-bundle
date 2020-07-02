<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Model\Response\Suggest;

class FmsUnitResponse extends SuggestResponse
{
    /**
     * @var string Код подразделения
     */
    public $code;

    /**
     * @var string Название подразделения в творительном падеже («кем выдан?»)
     */
    public $name;

    /**
     * @var string Код региона (2 цифры)
     */
    public $regionCode;

    /**
     * @var string Вид подразделения (1 цифра)
     *
     * 0 — подразделение ФМС
     * 1 — ГУВД или МВД региона
     * 2 — УВД или ОВД района или города
     * 3 — отделение полиции
     */
    public $type;
}
