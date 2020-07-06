<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Model\Response\Find;

use Velhron\DadataBundle\Model\Response\Suggest\SuggestResponse;

class DeliveryResponse extends SuggestResponse
{
    /**
     * @var string КЛАДР-код города
     */
    public $kladrId;

    /**
     * @var string ФИАС-код города
     */
    public $fiasId;

    /**
     * @var string Идентификатор города по справочнику Boxberry
     */
    public $boxberryId;

    /**
     * @var string Идентификатор города по справочнику СДЭК
     */
    public $cdekId;

    /**
     * @var string Идентификатор города по справочнику DPD
     */
    public $dpdId;
}
