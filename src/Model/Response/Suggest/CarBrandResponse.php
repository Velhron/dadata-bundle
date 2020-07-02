<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Model\Response\Suggest;

class CarBrandResponse extends SuggestResponse
{
    /**
     * @var string Идентификатор марки
     */
    public $id;

    /**
     * @var string Наименование марки
     */
    public $name;

    /**
     * @var string Наименование марки на русском
     */
    public $nameRu;
}
