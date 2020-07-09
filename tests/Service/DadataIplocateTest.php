<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Tests\Service;

use Velhron\DadataBundle\Service\DadataIplocate;

class DadataIplocateTest extends DadataServiceTest
{
    protected function createService(string $mockFilepath): DadataIplocate
    {
        return new DadataIplocate('', '', $this->resolver, $this->getMockHttpClient($mockFilepath));
    }

    public function testIplocateAddress(): void
    {
        $service = $this->createService(__DIR__.'/../mocks/Iplocate/address.json');
        $result = $service->iplocateAddress('46.226.227.20');

        $this->assertEquals('г Белгород', $result->value);
        $this->assertEquals('639efe9d-3fc8-4438-8e70-ec4f2321f2a7', $result->regionFiasId);
        $this->assertEquals('31000001000000000000000', $result->fiasCode);
    }
}
