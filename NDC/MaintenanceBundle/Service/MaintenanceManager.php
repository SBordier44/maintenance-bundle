<?php

namespace NDC\MaintenanceBundle\Service;

use Symfony\Component\DependencyInjection\ContainerInterface;

class MaintenanceManager
{
    /**
     * @var ContainerInterface
     */
    private $container;
    
    /**
     * @var array
     */
    private $config = [];
    
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
    
    public function enableMaintenanceAction(): bool
    {
        $file = $this->container->getParameter('kernel.root_dir') . '/../var/maintenance.lock';
        if(!file_exists($file))
        {
            touch($file);
            return TRUE;
        }
        return FALSE;
    }
    
    public function disableMaintenanceAction(): bool
    {
        $file = $this->container->getParameter('kernel.root_dir') . '/../var/maintenance.lock';
        if(file_exists($file))
        {
            unlink($file);
            return TRUE;
        }
        return FALSE;
    }
    
    public function getConfig(): array
    {
        return $this->config;
    }
    
    public function setConfig(array $config = []): MaintenanceManager
    {
        $this->config = $config;
        return $this;
    }
}
