<?php

declare(strict_types=1);

namespace Velhron\DadataBundle;

use Velhron\DadataBundle\Exception\InvalidConfigException;
use Velhron\DadataBundle\Model\Request\AbstractRequest;

class RequestFactory
{
    /**
     * @var Resolver
     */
    protected $resolver;

    public function __construct(Resolver $resolver)
    {
        $this->resolver = $resolver;
    }

    /**
     * @throws InvalidConfigException
     */
    public function create(string $methodName): AbstractRequest
    {
        $requestClass = $this->resolver->getMatchedRequest($methodName);

        if (null === $requestClass) {
            throw new InvalidConfigException("Для метода $methodName не указан параметр \"request\"");
        }

        $url = $this->resolver->getMatchedUrl($methodName);

        if (null === $url) {
            throw new InvalidConfigException("Для метода $methodName не указан параметр \"url\"");
        }

        return new $requestClass($url);
    }
}
