<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Model\Response;

abstract class AbstractResponse
{
    public function toCamelCase(string $value): string
    {
        return lcfirst(str_replace('_', '', ucwords($value, '_')));
    }
}
