<?php

namespace NDC\MaintenanceBundle\Event;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use NDC\MaintenanceBundle\Service\MaintenanceManager;
use Twig_Environment;

class MaintenanceListener
{
    /**
     * @var MaintenanceManager
     */
    protected $maintenanceService;
    /**
     * @var string
     */
    private $path;
    /**
     * @var Twig_Environment
     */
    private $twig;
    
    public function __construct(string $path, Twig_Environment $twig, MaintenanceManager $maintenanceManager)
    {
        $this->path               = $path . '/../var/maintenance.lock';
        $this->twig               = $twig;
        $this->maintenanceService = $maintenanceManager;
    }
    
    public function onKernelRequest(GetResponseEvent $event): void
    {
        $clientIps     = $event->getRequest()->getClientIps();
        $authorizedIps = $this->maintenanceService->getConfig();
        if(!file_exists($this->path)) return;
        foreach($clientIps as $clientIp)
        {
            if(in_array($clientIp, $authorizedIps, FALSE)) return;
        }
        $view = $this->twig->render('@NDCMaintenance/maintenance.html.twig');
        $event->setResponse(new Response($view, Response::HTTP_SERVICE_UNAVAILABLE));
        $event->stopPropagation();
    }
}
