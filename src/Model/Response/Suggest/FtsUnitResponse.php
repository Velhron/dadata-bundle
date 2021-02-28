<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Model\Response\Suggest;

class FtsUnitResponse extends SuggestResponse
{
    /**
     * @var string Код таможни
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
     * @var string ИНН
     */
    public $inn;

    /**
     * @var string ОГРН
     */
    public $ogrn;

    /**
     * @var string Код ОКПО
     */
    public $okpo;

    /**
     * @var string Код организационно-структурной формы
     */
    public $osf;

    /**
     * @var string Адрес
     */
    public $address;

    /**
     * @var string Телефон
     */
    public $phone;

    /**
     * @var string Факс
     */
    public $fax;

    /**
     * @var string Адрес эл. почты
     */
    public $email;
}
