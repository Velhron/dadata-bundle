<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Tests\Service;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;
use Velhron\DadataBundle\Resolver;
use Velhron\DadataBundle\Tests\TestingKernel;

abstract class DadataServiceTest extends TestCase
{
    /**
     * @var Resolver
     */
    protected $resolver;

    abstract protected function createService(string $mockFilepath);

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        $kernel = new TestingKernel('test', false);
        $kernel->boot();
        $container = $kernel->getContainer();
        $this->resolver = $container->get(Resolver::class);
    }

    protected function getMockHttpClient(string $filepath): MockHttpClient
    {
        return new MockHttpClient(new MockResponse(file_get_contents($filepath)));
    }
}
