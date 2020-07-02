<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Model\Response\Suggest;

class EmailResponse extends SuggestResponse
{
    /**
     * @var string Локальная часть адреса (то, что до «собачки»)
     */
    public $local;

    /**
     * @var string Домен (то, что после «собачки»)
     */
    public $domain;

    /**
     * @var string Тип адреса
     */
    public $type;

    /**
     * @var string Исходный e-mail
     */
    public $source;

    /**
     * @var int Код проверки
     */
    public $qc;
}
