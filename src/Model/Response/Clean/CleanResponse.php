<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Model\Response\Clean;

use Velhron\DadataBundle\Model\Response\AbstractResponse;

abstract class CleanResponse extends AbstractResponse
{
    /**
     * @var string Исходное значение
     */
    public $source;

    /**
     * @var string Стандартизированное значение
     */
    public $result;

    /**
     * @var int Код проверки (указывает на то, необходимо ли вручную проверить полученный результат)
     */
    public $qc;

    public function __construct(array $data)
    {
        foreach ($data as $property => $value) {
            $camelCaseProperty = $this->toCamelCase($property);
            if (property_exists($this, $camelCaseProperty)) {
                $this->{$camelCaseProperty} = $value;
            }
        }
    }
}
