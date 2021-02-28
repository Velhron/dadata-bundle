<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Tests\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Velhron\DadataBundle\Service\DadataSuggest;

class DadataSuggestTest extends DadataServiceTest
{
    protected function createService(string $mockFilepath): DadataSuggest
    {
        return new DadataSuggest('', '', $this->getMockHttpClient($mockFilepath), $this->requestFactory, $this->responseFactory);
    }

    public function testSuggestAddress(): void
    {
        $service = $this->createService(__DIR__.'/../mocks/Suggest/address.json');
        $result = $service->suggestAddress('москва хабар', ['count' => 10]);

        $this->assertCount(10, $result);
        $this->assertEquals('г Москва, ул Хабаровская', $result[0]->value);
        $this->assertEquals('0c5b2444-70a0-4932-980c-b4dc0d3f02b5', $result[0]->regionFiasId);
    }

    public function testSuggestParty(): void
    {
        $service = $this->createService(__DIR__.'/../mocks/Suggest/party.json');
        $result = $service->suggestParty('сбербанк', ['count' => 2]);

        $this->assertCount(2, $result);
        $this->assertEquals('ПАО СБЕРБАНК', $result[0]->value);
        $this->assertEquals('7707083893', $result[0]->inn);
        $this->assertEquals('773601001', $result[0]->kpp);
        $this->assertEquals('1027700132195', $result[0]->ogrn);
        $this->assertEquals('00032537', $result[0]->okpo);
        $this->assertEquals('45293554000', $result[0]->okato);
        $this->assertEquals('45397000000', $result[0]->oktmo);
        $this->assertEquals('4100104', $result[0]->okogu);
        $this->assertEquals('41', $result[0]->okfs);
        $this->assertEquals('г Москва, ул Вавилова, д 19', $result[0]->address->value);
    }

    public function testSuggestBank(): void
    {
        $service = $this->createService(__DIR__.'/../mocks/Suggest/bank.json');
        $result = $service->suggestBank('сбербанк', ['count' => 2]);

        $this->assertCount(2, $result);
        $this->assertEquals('ПАО Сбербанк', $result[0]->value);
        $this->assertEquals('30101810400000000225', $result[0]->correspondentAccount);
        $this->assertEquals('г Москва, ул Вавилова, д 19', $result[0]->address->value);
    }

    public function testSuggestFio(): void
    {
        $service = $this->createService(__DIR__.'/../mocks/Suggest/fio.json');
        $result = $service->suggestFio('Викт');

        $this->assertEquals('Виктор', $result[0]->value);
        $this->assertEquals('MALE', $result[0]->gender);
    }

    public function testSuggestEmail(): void
    {
        $service = $this->createService(__DIR__.'/../mocks/Suggest/email.json');
        $result = $service->suggestEmail('anton@');

        $this->assertEquals('anton@mail.ru', $result[0]->value);
        $this->assertEquals('anton', $result[0]->local);
        $this->assertEquals('mail.ru', $result[0]->domain);
    }

    public function testSuggestFias(): void
    {
        $service = $this->createService(__DIR__.'/../mocks/Suggest/fias.json');
        $result = $service->suggestFias('москва хабар', ['count' => 2]);

        $this->assertCount(2, $result);
        $this->assertEquals('г Москва, ул Хабаровская', $result[0]->value);
        $this->assertEquals('32fcb102-2a50-44c9-a00e-806420f448ea', $result[0]->fiasId);
    }

    public function testSuggestFmsUnit(): void
    {
        $service = $this->createService(__DIR__.'/../mocks/Suggest/fmsUnit.json');
        $result = $service->suggestFmsUnit('772 053');

        $this->assertEquals('ОВД ЗЮЗИНО Г. МОСКВЫ', $result[0]->value);
        $this->assertEquals('772-053', $result[0]->code);
        $this->assertEquals('77', $result[0]->regionCode);
    }

    public function testSuggestPostalUnit(): void
    {
        $service = $this->createService(__DIR__.'/../mocks/Suggest/postalUnit.json');
        $result = $service->suggestPostalUnit('дежнева 2а');

        $this->assertEquals('127642', $result[0]->value);
        $this->assertEquals('г Москва, проезд Дежнёва, д 2А', $result[0]->addressStr);
        $this->assertEquals('7700000000000', $result[0]->addressKladrId);
    }

    public function testSuggestFnsUnit(): void
    {
        $service = $this->createService(__DIR__.'/../mocks/Suggest/fnsUnit.json');
        $result = $service->suggestFnsUnit('нижнего');

        $this->assertEquals('Инспекция ФНС России по Автозаводскому району г.Нижнего Новгорода', $result[0]->value);
        $this->assertEquals('5256', $result[0]->code);
        $this->assertEquals('5256034801', $result[0]->inn);
    }

    public function testSuggestFtsUnit(): void
    {
        $service = $this->createService(__DIR__.'/../mocks/Suggest/ftsUnit.json');
        $result = $service->suggestFtsUnit('домодедово');

        $this->assertEquals('ДОМОДЕДОВСКАЯ', $result[0]->value);
        $this->assertEquals('ДОМОДЕДОВСКАЯ ТАМОЖНЯ', $result[0]->name);
        $this->assertEquals('10002000', $result[0]->code);
        $this->assertEquals('5009004697', $result[0]->inn);
        $this->assertEquals('domodedovo@ca.eais.customs.ru', $result[0]->email);
    }

    public function testSuggestRegionCourt(): void
    {
        $service = $this->createService(__DIR__.'/../mocks/Suggest/regionCourt.json');
        $result = $service->suggestRegionCourt('нижний');

        $this->assertEquals('52MS0001', $result[0]->code);
        $this->assertEquals('52', $result[0]->regionCode);
    }

    public function testSuggestMetro(): void
    {
        $service = $this->createService(__DIR__.'/../mocks/Suggest/metro.json');
        $result = $service->suggestMetro('алек');

        $this->assertEquals('Александровский сад', $result[0]->value);
        $this->assertEquals('7700000000000', $result[0]->cityKladrId);
        $this->assertEquals(55.752255, $result[0]->geoLat);
        $this->assertEquals(37.608775, $result[0]->geoLon);
    }

    public function testSuggestCarBrand(): void
    {
        $service = $this->createService(__DIR__.'/../mocks/Suggest/carBrand.json');
        $result = $service->suggestCarBrand('форд');

        $this->assertEquals('Ford', $result[0]->value);
        $this->assertEquals('Форд', $result[0]->nameRu);
    }

    public function testSuggestCountry(): void
    {
        $service = $this->createService(__DIR__.'/../mocks/Suggest/country.json');
        $result = $service->suggestCountry('та');

        $this->assertEquals('Таджикистан', $result[0]->value);
        $this->assertEquals('762', $result[0]->code);
    }

    public function testSuggestCurrency(): void
    {
        $service = $this->createService(__DIR__.'/../mocks/Suggest/currency.json');
        $result = $service->suggestCurrency('руб');

        $this->assertEquals('Белорусский рубль', $result[0]->value);
        $this->assertEquals('Российский рубль', $result[1]->value);
        $this->assertEquals('933', $result[0]->code);
        $this->assertEquals('643', $result[1]->code);
    }

    public function testSuggestOkved2(): void
    {
        $service = $this->createService(__DIR__.'/../mocks/Suggest/okved2.json');
        $result = $service->suggestOkved2('запуск');

        $this->assertEquals('H.51.22.3', $result[0]->idx);
        $this->assertEquals('51.22.3', $result[0]->kod);
    }

    public function testSuggestOkpd2(): void
    {
        $service = $this->createService(__DIR__.'/../mocks/Suggest/okpd2.json');
        $result = $service->suggestOkpd2('калоши');

        $this->assertEquals('Услуги по обрезиневанию валенок (рыбацкие калоши)', $result[0]->value);
        $this->assertEquals('S.95.23.10.133', $result[0]->idx);
    }

    public function testSuggestOktmo(): void
    {
        $service = $this->createService(__DIR__.'/../mocks/Suggest/oktmo.json');
        $result = $service->suggestOktmo('5462342');

        $this->assertEquals('54623422', $result[0]->oktmo);
        $this->assertEquals('Колпнянский', $result[0]->area);
        $this->assertEquals('54623000', $result[1]->areaCode);
        $this->assertEquals('Ярищенское', $result[1]->subarea);
    }

    public function testFindAddress(): void
    {
        $service = $this->createService(__DIR__.'/../mocks/Find/address.json');
        $result = $service->findAddress('77000000000268400');

        $this->assertEquals('129323, г Москва, ул Снежная', $result[0]->unrestrictedValue);
        $this->assertEquals('77000000000268400', $result[0]->kladrId);
    }

    public function testFindPostalUnit(): void
    {
        $service = $this->createService(__DIR__.'/../mocks/Find/postalUnit.json');
        $result = $service->findPostalUnit('127642');

        $this->assertEquals('127642', $result[0]->postalCode);
        $this->assertEquals('г Москва, проезд Дежнёва, д 2А', $result[0]->addressStr);
    }

    public function testFindDelivery(): void
    {
        $service = $this->createService(__DIR__.'/../mocks/Find/delivery.json');
        $result = $service->findDelivery('3100400100000');

        $this->assertEquals('3100400100000', $result[0]->kladrId);
        $this->assertEquals('01929', $result[0]->boxberryId);
        $this->assertEquals('196006461', $result[0]->dpdId);
    }

    public function testFindParty(): void
    {
        $service = $this->createService(__DIR__.'/../mocks/Find/party.json');
        $result = $service->findParty('7707083893');

        $this->assertEquals('145a83ab38c9ad95889a7b894ce57a97cf6f6d5f42932a71331ff18606edecc6', $result[0]->hid);
        $this->assertEquals('773601001', $result[0]->kpp);
        $this->assertEquals('г Москва, ул Вавилова, д 19', $result[0]->address->value);
    }

    public function testFindBank(): void
    {
        $service = $this->createService(__DIR__.'/../mocks/Find/bank.json');
        $result = $service->findBank('044525225');

        $this->assertEquals('SABRRUMM', $result[0]->swift);
        $this->assertEquals('7707083893', $result[0]->inn);
        $this->assertEquals('044525225', $result[0]->bic);
        $this->assertEquals('г Москва, ул Вавилова, д 19', $result[0]->address->value);
    }

    public function testFindFias(): void
    {
        $service = $this->createService(__DIR__.'/../mocks/Find/fias.json');
        $result = $service->findFias('77000000000268400');

        $this->assertEquals('г Москва, ул Снежная', $result[0]->value);
        $this->assertEquals('77000000000268400', $result[0]->kladrId);
    }

    public function testFindAffiliatedParty(): void
    {
        $service = $this->createService(__DIR__.'/../mocks/Find/affiliatedParty.json');
        $result = $service->findAffiliatedParty('7736207543');

        $this->assertEquals('ООО "ДЗЕН.ПЛАТФОРМА"', $result[0]->value);
        $this->assertEquals('770501001', $result[0]->kpp);
        $this->assertEquals('LEGAL', $result[0]->type);
        $this->assertEquals('7704431373', $result[0]->inn);
        $this->assertEquals('45286560000', $result[0]->okato);
    }

    public function testFindOktmo(): void
    {
        $service = $this->createService(__DIR__.'/../mocks/Find/oktmo.json');
        $result = $service->findOktmo('54623425');

        $this->assertEquals('54623425', $result[0]->value);
        $this->assertEquals('54623000', $result[0]->areaCode);
    }

    public function testFindFnsUnit(): void
    {
        $service = $this->createService(__DIR__.'/../mocks/Find/fnsUnit.json');
        $result = $service->findFnsUnit('5257');

        $this->assertEquals('Межрайонная инспекция ФНС России № 19 по Нижегородской области', $result[0]->value);
        $this->assertEquals('5257', $result[0]->code);
        $this->assertEquals('5257046101', $result[0]->inn);
    }

    public function testFindFtsUnit(): void
    {
        $service = $this->createService(__DIR__.'/../mocks/Find/ftsUnit.json');
        $result = $service->findFtsUnit('10002000');

        $this->assertEquals('ДОМОДЕДОВСКАЯ', $result[0]->value);
        $this->assertEquals('ДОМОДЕДОВСКАЯ ТАМОЖНЯ', $result[0]->name);
        $this->assertEquals('10002000', $result[0]->code);
        $this->assertEquals('5009004697', $result[0]->inn);
    }

    public function testCountry(): void
    {
        $service = $this->createService(__DIR__.'/../mocks/Find/country.json');
        $result = $service->findCountry('TH');

        $this->assertEquals('Таиланд', $result[0]->value);
        $this->assertEquals('Королевство Таиланд', $result[0]->name);
        $this->assertEquals('TH', $result[0]->alfa2);
        $this->assertEquals('764', $result[0]->code);
    }

    public function findRegionCourt(): void
    {
        $service = $this->createService(__DIR__.'/../mocks/Find/regionCourt.json');
        $result = $service->findRegionCourt('52MS0022');

        $this->assertEquals('52MS0001', $result[0]->code);
        $this->assertEquals('52', $result[0]->regionCode);
    }

    /**
     * @dataProvider suggestDataProvider
     */
    public function testSuggestRequestParams(
        string $methodName,
        string $methodUrl,
        string $query,
        string $filePath
    ): void {
        $expectedUrl = 'https://example.com/suggetions'.$methodUrl;

        $expectedOptions = [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Token token',
            ],
            'body' => json_encode(['query' => $query]),
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

        $service = new DadataSuggest('token', 'secret', $httpClient, $this->requestFactory, $this->responseFactory);

        $service->$methodName($query);
    }

    public function suggestDataProvider(): array
    {
        return [
            [
                'suggestAddress',
                '/suggest/address',
                'москва хабар',
                __DIR__.'/../mocks/Suggest/address.json',
            ],
            [
                'suggestParty',
                '/suggest/party',
                'сбербанк',
                __DIR__.'/../mocks/Suggest/party.json',
            ],
            [
                'suggestBank',
                '/suggest/bank',
                'сбербанк',
                __DIR__.'/../mocks/Suggest/bank.json',
            ],
            [
                'suggestFio',
                '/suggest/fio',
                'Викт',
                __DIR__.'/../mocks/Suggest/fio.json',
            ],
            [
                'suggestEmail',
                '/suggest/email',
                'anton@mail.ru',
                __DIR__.'/../mocks/Suggest/email.json',
            ],
            [
                'suggestFias',
                '/suggest/fias',
                'москва хабар',
                __DIR__.'/../mocks/Suggest/fias.json',
            ],
            [
                'suggestFmsUnit',
                '/suggest/fms_unit',
                '772 053',
                __DIR__.'/../mocks/Suggest/fmsUnit.json',
            ],
            [
                'suggestPostalUnit',
                '/suggest/postal_unit',
                'дежнева 2а',
                __DIR__.'/../mocks/Suggest/postalUnit.json',
            ],
            [
                'suggestFnsUnit',
                '/suggest/fns_unit',
                'нижнего',
                __DIR__.'/../mocks/Suggest/fnsUnit.json',
            ],
            [
                'suggestRegionCourt',
                '/suggest/region_court',
                'нижний',
                __DIR__.'/../mocks/Suggest/regionCourt.json',
            ],
            [
                'suggestMetro',
                '/suggest/metro',
                'алек',
                __DIR__.'/../mocks/Suggest/metro.json',
            ],
            [
                'suggestCarBrand',
                '/suggest/car_brand',
                'форд',
                __DIR__.'/../mocks/Suggest/carBrand.json',
            ],
            [
                'suggestCountry',
                '/suggest/country',
                'та',
                __DIR__.'/../mocks/Suggest/country.json',
            ],
            [
                'suggestCurrency',
                '/suggest/currency',
                'руб',
                __DIR__.'/../mocks/Suggest/currency.json',
            ],
            [
                'suggestOkved2',
                '/suggest/okved2',
                'запуск',
                __DIR__.'/../mocks/Suggest/okved2.json',
            ],
            [
                'suggestOkpd2',
                '/suggest/okpd2',
                'калоши',
                __DIR__.'/../mocks/Suggest/okpd2.json',
            ],
            [
                'suggestOktmo',
                '/suggest/oktmo',
                '5462342',
                __DIR__.'/../mocks/Suggest/oktmo.json',
            ],
            [
                'suggestFtsUnit',
                '/suggest/fts_unit',
                'домодедово',
                __DIR__.'/../mocks/Suggest/ftsUnit.json',
            ],
            [
                'findAddress',
                '/findById/address',
                '77000000000268400',
                __DIR__.'/../mocks/Find/address.json',
            ],
            [
                'findPostalUnit',
                '/findById/postal_unit',
                '127642',
                __DIR__.'/../mocks/Find/postalUnit.json',
            ],
            [
                'findDelivery',
                '/findById/delivery',
                '3100400100000',
                __DIR__.'/../mocks/Find/delivery.json',
            ],
            [
                'findParty',
                '/findById/party',
                '7707083893',
                __DIR__.'/../mocks/Find/party.json',
            ],
            [
                'findBank',
                '/findById/bank',
                '044525225',
                __DIR__.'/../mocks/Find/bank.json',
            ],
            [
                'findFias',
                '/findById/fias',
                '77000000000268400',
                __DIR__.'/../mocks/Find/fias.json',
            ],
            [
                'findAffiliatedParty',
                '/findAffiliated/party',
                '7736207543',
                __DIR__.'/../mocks/Find/affiliatedParty.json',
            ],
            [
                'findOktmo',
                '/findById/oktmo',
                '54623425',
                __DIR__.'/../mocks/Find/oktmo.json',
            ],
            [
                'findFnsUnit',
                '/findById/fns_unit',
                '5257',
                __DIR__.'/../mocks/Find/fnsUnit.json',
            ],
            [
                'findFtsUnit',
                '/findById/fts_unit',
                '10002000',
                __DIR__.'/../mocks/Find/ftsUnit.json',
            ],
            [
                'findCountry',
                '/findById/country',
                'TH',
                __DIR__.'/../mocks/Find/country.json',
            ],
            [
                'findRegionCourt',
                '/findById/region_court',
                '52MS0022',
                __DIR__.'/../mocks/Find/regionCourt.json',
            ],
        ];
    }
}
