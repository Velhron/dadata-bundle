<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Tests\Service;

class DadataGeolocateTest extends DadataServiceTest
{
    public function testGeolocateAddress(): void
    {
        $service = $this->createGeolocateService(__DIR__.'/../Mock/Geolocate/address.json');
        $result = $service->geolocateAddress(55.878, 37.653);

        $this->assertEquals('г Москва, ул Сухонская, д 11', $result[0]->value);
        $this->assertEquals('7700000000028360004', $result[0]->kladrId);
    }

    public function testGeolocatePostalUnit(): void
    {
        $service = $this->createGeolocateService(__DIR__.'/../Mock/Geolocate/postalUnit.json');
        $result = $service->geolocatePostalUnit(55.878, 37.653, ['radius_meters' => 1000]);

        $this->assertEquals('127642', $result[0]->postalCode);
        $this->assertEquals('г Москва, проезд Дежнёва, д 2А', $result[0]->addressStr);
    }
}
