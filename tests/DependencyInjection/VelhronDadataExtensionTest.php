<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Tests\DependencyInjection;

use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Yaml\Yaml;
use Velhron\DadataBundle\DependencyInjection\VelhronDadataExtension;

class VelhronDadataExtensionTest extends TestCase
{
    public function testRegister(): void
    {
        $config = Yaml::parse(file_get_contents(__DIR__.'/config.yaml'));

        $containerBuilder = new ContainerBuilder();
        $containerBuilder->setParameter('kernel.debug', true);

        $extension = new VelhronDadataExtension();
        $extension->load($config, $containerBuilder);

        $this->assertSame('token', $containerBuilder->getParameter('velhron_dadata.token'));
        $this->assertSame('secret', $containerBuilder->getParameter('velhron_dadata.secret'));
    }
}
