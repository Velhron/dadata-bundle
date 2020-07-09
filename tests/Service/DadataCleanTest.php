<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Tests\Service;

class DadataCleanTest extends DadataServiceTest
{
    public function testCleanAddress(): void
    {
        $service = $this->createCleanService(__DIR__.'/../Mock/Clean/address.json');
        $result = $service->cleanAddress('мск сухонска 11/-89');

        $this->assertEquals(0, $result->qc);
        $this->assertEquals('г Москва, ул Сухонская, д 11, кв 89', $result->result);
        $this->assertEquals('77000000000000028360004', $result->fiasCode);
    }

    public function testCleanPhone(): void
    {
        $service = $this->createCleanService(__DIR__.'/../Mock/Clean/phone.json');
        $result = $service->cleanPhone('раб 846)231.60.14 *139');

        $this->assertEquals('+7 846 231-60-14 доб. 139', $result->phone);
        $this->assertEquals('ООО "СИПАУТНЭТ"', $result->provider);
    }

    public function testCleanPassport(): void
    {
        $service = $this->createCleanService(__DIR__.'/../Mock/Clean/passport.json');
        $result = $service->cleanPassport('4509 235857');

        $this->assertEquals('45 09', $result->series);
        $this->assertEquals('235857', $result->number);
    }

    public function testCleanBirthdate(): void
    {
        $service = $this->createCleanService(__DIR__.'/../Mock/Clean/birthdate.json');
        $result = $service->cleanBirthdate('24/3/12');

        $this->assertEquals('24.03.2012', $result->birthdate);
    }

    public function testCleanVehicle(): void
    {
        $service = $this->createCleanService(__DIR__.'/../Mock/Clean/vehicle.json');
        $result = $service->cleanVehicle('бмв');

        $this->assertEquals('BMW', $result->brand);
    }

    public function testCleanName(): void
    {
        $service = $this->createCleanService(__DIR__.'/../Mock/Clean/name.json');
        $result = $service->cleanName('Срегей владимерович иванов');

        $this->assertEquals('Иванов', $result->surname);
        $this->assertEquals('Сергей', $result->name);
        $this->assertEquals('Владимирович', $result->patronymic);
    }

    public function testCleanEmail(): void
    {
        $service = $this->createCleanService(__DIR__.'/../Mock/Clean/email.json');
        $result = $service->cleanEmail('serega@yandex/ru');

        $this->assertEquals('serega@yandex.ru', $result->email);
    }
}
