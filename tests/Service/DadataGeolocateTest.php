<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Tests\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Velhron\DadataBundle\Service\DadataGeolocate;

class DadataGeolocateTest extends DadataServiceTest
{
    protected function createService(string $mockFilepath): DadataGeolocate
    {
        return new DadataGeolocate('', '', $this->getMockHttpClient($mockFilepath), $this->requestFactory, $this->responseFactory);
    }

    public function testGeolocateAddress(): void
    {
        $service = $this->createService(__DIR__.'/../mocks/Geolocate/address.json');
        $result = $service->geolocateAddress(55.878, 37.653);

        $this->assertEquals('г Москва, ул Сухонская, д 11', $result[0]->value);
        $this->assertEquals('7700000000028360004', $result[0]->kladrId);
    }

    public function testGeolocatePostalUnit(): void
    {
        $service = $this->createService(__DIR__.'/../mocks/Geolocate/postalUnit.json');
        $result = $service->geolocatePostalUnit(55.878, 37.653, ['radius_meters' => 1000]);

        $this->assertEquals('127642', $result[0]->postalCode);
        $this->assertEquals('г Москва, проезд Дежнёва, д 2А', $result[0]->addressStr);
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
            'body' => '{"lat":55.878,"lon":37.653}',
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
            ->with('POST', $expectedUrl, $expectedOptions)
            ->willReturn($response);

        $service = new DadataGeolocate('token', 'secret', $httpClient, $this->requestFactory, $this->responseFactory);

        $service->$methodName(55.878, 37.653);
    }

    public function dataProvider(): array
    {
        return [
            [
                'geolocateAddress',
                '/geolocate/address',
                __DIR__.'/../mocks/Geolocate/address.json',
            ],
            [
                'geolocatePostalUnit',
                '/geolocate/postal_unit',
                __DIR__.'/../mocks/Geolocate/postalUnit.json',
            ],
        ];
    }
}
