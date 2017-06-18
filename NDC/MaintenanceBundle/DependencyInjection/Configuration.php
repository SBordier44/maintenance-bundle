<?php

namespace NDC\MaintenanceBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder();
        $rootNode    = $treeBuilder->root('ndc_maintenance');
        $rootNode->children()->arrayNode('authorized_ips')->prototype('scalar')->end();
        return $treeBuilder;
    }
}
