<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Model\Response\Suggest;

class FnsUnitResponse extends SuggestResponse
{
    /**
     * @var string Код инспекции
     */
    public $code;

    /**
     * @var string Полное название
     */
    public $name;

    /**
     * @var string Краткое название
     */
    public $nameShort;

    /**
     * @var string Адрес
     */
    public $address;

    /**
     * @var string Телефоны
     */
    public $phone;

    /**
     * @var string ОКПО и режим работы
     */
    public $comment;

    /**
     * @var string Получатель платежа
     */
    public $paymentName;

    /**
     * @var string Коды ОКТМО бюджетополучателя
     */
    public $oktmo;

    /**
     * @var string ИНН получателя
     */
    public $inn;

    /**
     * @var string КПП получателя
     */
    public $kpp;

    /**
     * @var string Название банка получателя
     */
    public $bankName;

    /**
     * @var string БИК банка получателя
     */
    public $bankBik;

    /**
     * @var string Корсчет банка получателя
     */
    public $bankCorrespondentAccount;

    /**
     * @var string Номер счёта получателя
     */
    public $bankAccount;

    /**
     * @var string Код регистрирующей инспекции
     */
    public $parentCode;

    /**
     * @var string Полное название регистрирующей инспекции
     */
    public $parentName;

    /**
     * @var string Адрес регистрирующей инспекции
     */
    public $parentAddress;

    /**
     * @var string Телефоны регистрирующей инспекции
     */
    public $parentPhone;

    /**
     * @var string Режим работы регистрирующей инспекции
     */
    public $parentComment;
}
