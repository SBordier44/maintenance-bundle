<?php

namespace NDC\MaintenanceBundle\Service;

class MaintenanceManager
{
    /**
     * @var array
     */
    private $config = [];
    /**
     * @var string
     */
    private $kernelRoot;
    
    public function __construct(string $kernelRoot)
    {
        $this->kernelRoot = $kernelRoot;
    }
    
    public function enableMaintenanceAction(): bool
    {
        $file = $this->kernelRoot . '/../var/maintenance.lock';
        if (!file_exists($file)) {
            touch($file);
            return true;
        }
        return false;
    }
    
    public function disableMaintenanceAction(): bool
    {
        $file = $this->kernelRoot . '/../var/maintenance.lock';
        if (file_exists($file)) {
            unlink($file);
            return true;
        }
        return false;
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
