<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Tests\Service;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;
use Velhron\DadataBundle\Resolver;
use Velhron\DadataBundle\Service\DadataGeolocate;
use Velhron\DadataBundle\Service\DadataIplocate;
use Velhron\DadataBundle\Service\DadataSuggest;
use Velhron\DadataBundle\Tests\TestingKernel;

abstract class DadataServiceTest extends TestCase
{
    /**
     * @var Resolver
     */
    private $resolver;

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

    protected function createSuggestService(string $filepath): DadataSuggest
    {
        return new DadataSuggest('', '', $this->resolver, $this->getMockHttpClient($filepath));
    }

    protected function createIplocateService(string $filepath): DadataIplocate
    {
        return new DadataIplocate('', '', $this->resolver, $this->getMockHttpClient($filepath));
    }

    protected function createGeolocateService(string $filepath): DadataGeolocate
    {
        return new DadataGeolocate('', '', $this->resolver, $this->getMockHttpClient($filepath));
    }
}
