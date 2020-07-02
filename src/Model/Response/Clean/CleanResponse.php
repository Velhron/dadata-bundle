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
     * @var int Код проверки
     *
     * Определяет, требуется ли вручную проверить распознанное значение.
     * Возможны следующие варианты:
     * 0 - Исходное значение распознано уверенно
     * 1 - Исходное значение распознано с допущениями или не распознано
     * 2 - Исходное значение пустое или заведомо «мусорное»
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
