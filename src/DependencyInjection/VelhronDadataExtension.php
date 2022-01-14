<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class VelhronDadataExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yaml');

        $container->setParameter('velhron_dadata.token', $config['token']);
        $container->setParameter('velhron_dadata.secret', $config['secret']);
        $container->setParameter('velhron_dadata.base_general_url', $config['base_general_url']);
        $container->setParameter('velhron_dadata.base_cleaner_url', $config['base_cleaner_url']);
        $container->setParameter('velhron_dadata.base_suggestions_url', $config['base_suggestions_url']);
    }
}
