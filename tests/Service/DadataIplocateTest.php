<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Tests\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Velhron\DadataBundle\Service\DadataIplocate;

class DadataIplocateTest extends DadataServiceTest
{
    protected function createService(string $mockFilepath): DadataIplocate
    {
        return new DadataIplocate('', '', $this->getMockHttpClient($mockFilepath), $this->requestFactory, $this->responseFactory);
    }

    public function testIplocateAddress(): void
    {
        $service = $this->createService(__DIR__.'/../mocks/Iplocate/address.json');
        $result = $service->iplocateAddress('46.226.227.20');

        $this->assertEquals('г Белгород', $result->value);
        $this->assertEquals('639efe9d-3fc8-4438-8e70-ec4f2321f2a7', $result->regionFiasId);
        $this->assertEquals('31000001000000000000000', $result->fiasCode);
    }

    /**
     * @dataProvider dataProvider
     */
    public function testRequestParams(string $methodName, string $methodUrl, string $filePath): void
    {
        $expectedUrl = 'https://example.com/suggetions'.$methodUrl;

        $expectedOptions = [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Token token',
            ],
            'query' => ['ip' => '46.226.227.20'],
        ];

        $response = $this->createMock(ResponseInterface::class);

        $response
            ->expects($this->once())
            ->method('getContent')
            ->willReturn(file_get_contents($filePath));

        $httpClient = $this->createMock(HttpClientInterface::class);

        $httpClient
            ->expects($this->once())
            ->method('request')
            ->with('GET', $expectedUrl, $expectedOptions)
            ->willReturn($response);

        $service = new DadataIplocate('token', 'secret', $httpClient, $this->requestFactory, $this->responseFactory);

        $service->$methodName('46.226.227.20');
    }

    public function dataProvider(): array
    {
        return [
            [
                'iplocateAddress',
                '/iplocate/address',
                __DIR__.'/../mocks/Iplocate/address.json',
            ],
        ];
    }
}
