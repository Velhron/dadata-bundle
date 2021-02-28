<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Tests\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Velhron\DadataBundle\Service\DadataGeneral;

class DadataGeneralTest extends DadataServiceTest
{
    protected function createService(string $mockFilepath): DadataGeneral
    {
        return new DadataGeneral('', '', $this->getMockHttpClient($mockFilepath), $this->requestFactory, $this->responseFactory);
    }

    public function testBalance(): void
    {
        $service = $this->createService(__DIR__.'/../mocks/General/balance.json');
        $result = $service->balance();

        $this->assertEquals(7.0, $result);
    }

    public function testStat(): void
    {
        $service = $this->createService(__DIR__.'/../mocks/General/stat.json');
        $result = $service->stat();

        $this->assertEquals('2020-07-09', $result->date);
        $this->assertEquals(36, $result->suggestions);
        $this->assertEquals(7, $result->clean);
    }

    /**
     * @dataProvider dataProvider
     */
    public function testRequestParams(string $methodName, string $methodUrl, string $filePath): void
    {
        $expectedUrl = 'https://example.com/general'.$methodUrl;

        $expectedOptions = [
            'headers' => [
                'Authorization' => 'Token token',
                'X-Secret' => 'secret',
            ],
            'query' => [],
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

        $service = new DadataGeneral('token', 'secret', $httpClient, $this->requestFactory, $this->responseFactory);

        $service->$methodName();
    }

    public function dataProvider(): array
    {
        return [
            [
                'balance',
                '/profile/balance',
                __DIR__.'/../mocks/General/balance.json',
            ],
            [
                'stat',
                '/stat/daily',
                __DIR__.'/../mocks/General/stat.json',
            ],
        ];
    }
}
