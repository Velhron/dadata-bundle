<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Tests\Service;

class DadataIplocateTest extends DadataServiceTest
{
    public function testIplocateAddress(): void
    {
        $service = $this->createIplocateService(__DIR__.'/../Mock/Iplocate/address.json');
        $result = $service->iplocateAddress('46.226.227.20');

        $this->assertEquals('г Белгород', $result->value);
        $this->assertEquals('639efe9d-3fc8-4438-8e70-ec4f2321f2a7', $result->regionFiasId);
        $this->assertEquals('31000001000000000000000', $result->fiasCode);
    }
}
