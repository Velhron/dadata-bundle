<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Velhron\DadataBundle\Exception\DadataException;
use Velhron\DadataBundle\Model\Request\AbstractRequest;
use Velhron\DadataBundle\Resolver;

abstract class AbstractService
{
    /**
     * @var string API-ключ
     */
    protected $token;

    /**
     * @var string Секретный ключ для стандартизации
     */
    protected $secret;

    /**
     * @var Resolver
     */
    protected $resolver;

    /**
     * @var HttpClientInterface HTTP-клиент
     */
    protected $httpClient;

    public function __construct(string $token, string $secret, Resolver $resolver, HttpClientInterface $httpClient)
    {
        $this->token = $token;
        $this->secret = $secret;
        $this->resolver = $resolver;
        $this->httpClient = $httpClient;
    }

    /**
     * @throws DadataException
     */
    abstract protected function query(AbstractRequest $request): array;
}
