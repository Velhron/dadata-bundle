<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Tests;

use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;
use Velhron\DadataBundle\VelhronDadataBundle;

class TestingKernel extends Kernel
{
    /**
     * {@inheritdoc}
     */
    public function registerBundles()
    {
        return [
            new VelhronDadataBundle(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/DependencyInjection/config.yaml');
    }
}
