<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Tests\Service;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;
use Velhron\DadataBundle\Resolver;

abstract class DadataServiceTest extends KernelTestCase 
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
        self::bootKernel();
        $container = self::$container;
        $this->resolver = $container->get(Resolver::class);
    }

    protected function getMockHttpClient(string $filepath): MockHttpClient
    {
        return new MockHttpClient(new MockResponse(file_get_contents($filepath)));
    }
}
