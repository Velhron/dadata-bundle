<?php

declare(strict_types=1);

namespace Velhron\DadataBundle;

class Resolver
{
    private $methods;

    /**
     * Resolver constructor.
     */
    public function __construct(array $methods)
    {
        $this->methods = $methods;
    }

    public function getMatchedRequest(string $methodName): ?string
    {
        $method = $this->resolve($methodName);

        return $method ? $method['request'] : null;
    }

    public function getMatchedResponse(string $methodName): ?string
    {
        $method = $this->resolve($methodName);

        return $method ? $method['response'] : null;
    }

    public function resolve(string $methodName): ?array
    {
        $key = array_search($methodName, array_column($this->methods, 'name'));

        return false !== $key ? $this->methods[$key] : null;
    }
}
