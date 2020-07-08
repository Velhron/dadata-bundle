<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Model\Response\Suggest;

use Velhron\DadataBundle\Model\Response\AbstractResponse;

abstract class SuggestResponse extends AbstractResponse
{
    /**
     * @var string Значение одной строкой (как показывается в списке подсказок)
     */
    public $value;

    /**
     * @var string Значение
     */
    public $unrestrictedValue;

    public function __construct(array $data)
    {
        $this->value = $data['value'] ?? null;
        $this->unrestrictedValue = $data['unrestricted_value'] ?? null;

        foreach ($data['data'] ?? [] as $property => $value) {
            $camelCaseProperty = $this->toCamelCase($property);
            if (property_exists($this, $camelCaseProperty)) {
                $this->{$camelCaseProperty} = $value;
            }
        }
    }
}
