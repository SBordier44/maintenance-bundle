<?php

namespace NDC\MaintenanceBundle\Twig;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Twig_Extension;
use Twig_SimpleFunction;

class AppExtension extends Twig_Extension
{
    /**
     * @var ContainerInterface
     */
    private $container;
    
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
    
    public function getFunctions(): array
    {
        return [
            new Twig_SimpleFunction('isMaintenanceMode', [$this, 'isMaintenanceMode'])
        ];
    }
    
    public function isMaintenanceMode(): bool
    {
        $file = $this->container->getParameter('kernel.root_dir') . '/../var/maintenance.lock';
        return (bool)file_exists($file);
    }
}
