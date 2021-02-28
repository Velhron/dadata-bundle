<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Tests\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Velhron\DadataBundle\Service\DadataClean;

class DadataCleanTest extends DadataServiceTest
{
    protected function createService(string $mockFilepath): DadataClean
    {
        return new DadataClean('', '', $this->getMockHttpClient($mockFilepath), $this->requestFactory, $this->responseFactory);
    }

    public function testCleanAddress(): void
    {
        $service = $this->createService(__DIR__.'/../mocks/Clean/address.json');
        $result = $service->cleanAddress('мск сухонска 11/-89');

        $this->assertEquals(0, $result->qc);
        $this->assertEquals('г Москва, ул Сухонская, д 11, кв 89', $result->result);
        $this->assertEquals('77000000000000028360004', $result->fiasCode);
    }

    public function testCleanPhone(): void
    {
        $service = $this->createService(__DIR__.'/../mocks/Clean/phone.json');
        $result = $service->cleanPhone('раб 846)231.60.14 *139');

        $this->assertEquals('+7 846 231-60-14 доб. 139', $result->phone);
        $this->assertEquals('ООО "СИПАУТНЭТ"', $result->provider);
    }

    public function testCleanPassport(): void
    {
        $service = $this->createService(__DIR__.'/../mocks/Clean/passport.json');
        $result = $service->cleanPassport('4509 235857');

        $this->assertEquals('45 09', $result->series);
        $this->assertEquals('235857', $result->number);
    }

    public function testCleanBirthdate(): void
    {
        $service = $this->createService(__DIR__.'/../mocks/Clean/birthdate.json');
        $result = $service->cleanBirthdate('24/3/12');

        $this->assertEquals('24.03.2012', $result->birthdate);
    }

    public function testCleanVehicle(): void
    {
        $service = $this->createService(__DIR__.'/../mocks/Clean/vehicle.json');
        $result = $service->cleanVehicle('бмв');

        $this->assertEquals('BMW', $result->brand);
    }

    public function testCleanName(): void
    {
        $service = $this->createService(__DIR__.'/../mocks/Clean/name.json');
        $result = $service->cleanName('Срегей владимерович иванов');

        $this->assertEquals('Иванов', $result->surname);
        $this->assertEquals('Сергей', $result->name);
        $this->assertEquals('Владимирович', $result->patronymic);
    }

    public function testCleanEmail(): void
    {
        $service = $this->createService(__DIR__.'/../mocks/Clean/email.json');
        $result = $service->cleanEmail('serega@yandex/ru');

        $this->assertEquals('serega@yandex.ru', $result->email);
    }

    /**
     * @dataProvider dataProvider
     */
    public function testRequestParams(
        string $methodName,
        string $methodUrl,
        string $query,
        string $filePath
    ): void {
        $expectedUrl = 'https://example.com/cleaner'.$methodUrl;

        $expectedOptions = [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Token token',
                'X-Secret' => 'secret',
            ],
            'body' => json_encode([$query]),
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

        $service = new DadataClean('token', 'secret', $httpClient, $this->requestFactory, $this->responseFactory);

        $service->$methodName($query);
    }

    public function dataProvider(): array
    {
        return [
            [
                'cleanAddress',
                '/address',
                'мск сухонска 11/-89',
                __DIR__.'/../mocks/Clean/address.json',
            ],
            [
                'cleanPhone',
                '/phone',
                'раб 846)231.60.14 *139',
                __DIR__.'/../mocks/Clean/phone.json',
            ],
            [
                'cleanPassport',
                '/passport',
                '4509 235857',
                __DIR__.'/../mocks/Clean/passport.json',
            ],
            [
                'cleanBirthdate',
                '/birthdate',
                '24/3/12',
                __DIR__.'/../mocks/Clean/birthdate.json',
            ],
            [
                'cleanVehicle',
                '/vehicle',
                'бмв',
                __DIR__.'/../mocks/Clean/vehicle.json',
            ],
            [
                'cleanName',
                '/name',
                'Срегей владимерович иванов',
                __DIR__.'/../mocks/Clean/name.json',
            ],
            [
                'cleanEmail',
                '/email',
                'serega@yandex/ru',
                __DIR__.'/../mocks/Clean/email.json',
            ],
        ];
    }
}
