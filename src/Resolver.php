<?php

declare(strict_types=1);

namespace Velhron\DadataBundle;

use Velhron\DadataBundle\Exception\InvalidConfigException;

class Resolver
{
    /**
     * @var array
     */
    private $methodsByName;

    /**
     * Resolver constructor.
     *
     * @throws InvalidConfigException
     */
    public function __construct(array $methods)
    {
        foreach ($methods as $method) {
            if (isset($method['name'])) {
                if (isset($this->methodsByName[$method['name']])) {
                    throw new InvalidConfigException('Наименование метода должно быть уникально');
                }

                $this->methodsByName[$method['name']] = $method;
            } else {
                throw new InvalidConfigException('Для одного из методов не указан параметр "name"');
            }
        }
    }

    public function getMatchedRequest(string $methodName): ?string
    {
        $method = $this->resolve($methodName);

        return isset($method, $method['request']) ? $method['request'] : null;
    }

    public function getMatchedResponse(string $methodName): ?string
    {
        $method = $this->resolve($methodName);

        return isset($method, $method['response']) ? $method['response'] : null;
    }

    public function getMatchedUrl(string $methodName): ?string
    {
        $method = $this->resolve($methodName);

        return isset($method, $method['url']) ? $method['url'] : null;
    }

    public function resolve(string $methodName): ?array
    {
        return $this->methodsByName[$methodName] ?? null;
    }
}
