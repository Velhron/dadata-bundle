<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Tests\Service;

use Velhron\DadataBundle\Service\DadataGeneral;

class DadataGeneralTest extends DadataServiceTest
{
    protected function createService(string $mockFilepath): DadataGeneral
    {
        return new DadataGeneral('', '', $this->resolver, $this->getMockHttpClient($mockFilepath));
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
}
