<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Tests\Service;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;
use Velhron\DadataBundle\RequestFactory;
use Velhron\DadataBundle\ResponseFactory;
use Velhron\DadataBundle\Tests\TestingKernel;

abstract class DadataServiceTest extends TestCase
{
    /**
     * @var RequestFactory
     */
    protected $requestFactory;

    /**
     * @var ResponseFactory
     */
    protected $responseFactory;

    abstract protected function createService(string $mockFilepath);

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        $kernel = new TestingKernel('test', false);
        $kernel->boot();
        $container = $kernel->getContainer();
        $this->requestFactory = $container->get(RequestFactory::class);
        $this->responseFactory = $container->get(ResponseFactory::class);
    }

    protected function getMockHttpClient(string $filepath): MockHttpClient
    {
        return new MockHttpClient(new MockResponse(file_get_contents($filepath)));
    }
}
