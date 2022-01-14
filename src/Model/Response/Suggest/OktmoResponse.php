<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Model\Response\Suggest;

class OktmoResponse extends SuggestResponse
{
    /**
     * @var string Код ОКТМО
     */
    public $oktmo;

    /**
     * @var string Тип муниципального района
     */
    public $areaType;

    /**
     * @var string Код муниципального района
     */
    public $areaCode;

    /**
     * @var string Название муниципального района
     */
    public $area;

    /**
     * @var string Тип муниципального поселения
     *
     * 1 — городское поселение
     * 2 — сельское поселение
     * 3 — межселенная территория в составе муниципального района
     * 4 — внутригородской район городского округа
     */
    public $subareaType;

    /**
     * @var string Код муниципального поселения
     */
    public $subareaCode;

    /**
     * @var string Название муниципального поселения
     */
    public $subarea;
}
