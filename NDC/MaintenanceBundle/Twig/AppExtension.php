<?php

namespace NDC\MaintenanceBundle\Twig;

use Twig_Extension;
use Twig_SimpleFunction;

class AppExtension extends Twig_Extension
{
    /**
     * @var string
     */
    private $kernelRoot;
    
    public function __construct(string $kernelRoot)
    {
        $this->kernelRoot = $kernelRoot;
    }
    
    public function getFunctions(): array
    {
        return [
            new Twig_SimpleFunction('isMaintenanceMode', [$this, 'isMaintenanceMode'])
        ];
    }
    
    public function isMaintenanceMode(): bool
    {
        $file = $this->kernelRoot . '/../var/maintenance.lock';
        return file_exists($file);
    }
}
