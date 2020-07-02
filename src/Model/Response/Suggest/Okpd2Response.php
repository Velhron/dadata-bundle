<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Model\Response\Suggest;

class Okpd2Response extends SuggestResponse
{
    /**
     * @var string Индекс (раздел + код)
     */
    public $idx;

    /**
     * @var string Код раздела
     */
    public $razdel;

    /**
     * @var string Код
     */
    public $kod;

    /**
     * @var string Наименование
     */
    public $name;
}
