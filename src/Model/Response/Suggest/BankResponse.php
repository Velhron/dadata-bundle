<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Model\Response\Suggest;

class BankResponse extends SuggestResponse
{
    /**
     * @var string Банковский идентификационный код (БИК) ЦБ РФ
     */
    public $bic;

    /**
     * @var string Банковский идентификационный код в системе SWIFT
     */
    public $swift;

    /**
     * @var string ИНН
     */
    public $inn;

    /**
     * @var string КПП
     */
    public $kpp;

    /**
     * @var string Регистрационный номер в ЦБ РФ
     */
    public $registrationNumber;

    /**
     * @var string Корреспондентский счет в ЦБ РФ
     */
    public $correspondentAccount;

    /**
     * @var array Наименование
     */
    public $name;

    /**
     * @var string Город для платежного поручения (поля справочника Tnp + Nnp)
     */
    public $paymentCity;

    /**
     * @var array Тип кредитной организации
     */
    public $opf;

    /**
     * @var AddressResponse Адрес регистрации
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
