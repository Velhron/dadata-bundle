<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Model\Response\Clean;

class VehicleResponse extends CleanResponse
{
    /**
     * @var string Марка
     */
    public $brand;

    /**
     * @var string Модель
     */
    public $model;
}
