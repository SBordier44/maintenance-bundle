<?php

namespace NDC\MaintenanceBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class NDCMaintenanceExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $configuration = new Configuration();
        $config        = $this->processConfiguration($configuration, $configs);
        $loader        = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');
        if(array_key_exists('authorized_ips', $config))
        {
            $container->getDefinition('maintenance.service')->addMethodCall('setConfig', [$config['authorized_ips']]);
        } else
        {
            $container->getDefinition('maintenance.service')->addMethodCall('setConfig', []);
        }
        
    }
}
