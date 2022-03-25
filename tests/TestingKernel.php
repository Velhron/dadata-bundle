<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\Tests;

use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;
use Velhron\DadataBundle\VelhronDadataBundle;

if (version_compare(Kernel::VERSION, '6.0', '<')) {
    class TestingKernel extends Kernel
    {
        /**
         * @return iterable<mixed, Symfony\Component\HttpKernel\Bundle\BundleInterface>
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
} else {
    class TestingKernel extends Kernel
    {
        public function registerBundles(): iterable
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
}
