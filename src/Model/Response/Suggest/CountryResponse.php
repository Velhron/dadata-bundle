<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Model\Response\Suggest;

class CountryResponse extends SuggestResponse
{
    /**
     * @var string Цифровой код страны
     */
    public $code;

    /**
     * @var string Буквенный код альфа-2
     */
    public $alfa2;

    /**
     * @var string Буквенный код альфа-3
     */
    public $alfa3;

    /**
     * @var string Краткое наименование страны
     */
    public $nameShort;

    /**
     * @var string Полное официальное наименование страны
     */
    public $name;
}
