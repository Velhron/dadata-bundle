<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Model\Response\Find;

use Velhron\DadataBundle\Model\Response\Suggest\AddressResponse;
use Velhron\DadataBundle\Model\Response\Suggest\SuggestResponse;

class AffiliatedPartyResponse extends SuggestResponse
{
    /**
     * @var string ИНН
     */
    public $inn;

    /**
     * @var string КПП
     */
    public $kpp;

    /**
     * @var string ОГРН
     */
    public $ogrn;

    /**
     * @var string Уникальный идентификатор в Дадате
     */
    public $hid;

    /**
     * @var string Тип организации (LEGAL — юридическое лицо, INDIVIDUAL — индивидуальный предприниматель)
     */
    public $type;

    /**
     * @var string Код ОКАТО
     */
    public $okato;

    /**
     * @var string Код ОКТМО
     */
    public $oktmo;

    /**
     * @var string Код ОКПО
     */
    public $okpo;

    /**
     * @var string Код ОКОГУ
     */
    public $okogu;

    /**
     * @var string Код ОКФС
     */
    public $okfs;

    /**
     * @var string Код ОКВЭД
     */
    public $okved;

    /**
     * @var string Версия справочника ОКВЭД (2001 или 2014)
     */
    public $okvedType;

    /**
     * @var string Количество филиалов
     */
    public $branchCount;

    /**
     * @var string Тип подразделения (MAIN — головная организация, BRANCH — филиал)
     */
    public $branchType;

    /**
     * @var AddressResponse Адрес одной строкой
     */
    public $address;

    /**
     * @var array Состояние
     */
    public $state;

    public function __construct(array $data)
    {
        parent::__construct($data);

        if (isset($data['data']['address'])) {
            $this->address = new AddressResponse($data['data']['address']);
        }
    }
}
