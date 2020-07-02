<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Model\Response\Suggest;

class CurrencyResponse extends SuggestResponse
{
    /**
     * @var string Цифровой код валюты
     */
    public $code;

    /**
     * @var string Буквенный код валюты
     */
    public $strcode;

    /**
     * @var string Наименование валюты
     */
    public $name;

    /**
     * @var string Страна, в которой эта валюта является ее денежной единицей
     */
    public $country;
}
