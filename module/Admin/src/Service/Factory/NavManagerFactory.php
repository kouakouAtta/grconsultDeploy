<?php
namespace Admin\Service\Factory;

use Interop\Container\ContainerInterface;
use Admin\Service\NavManager;
use Admin\Service\RbacManager;
use Laminas\Authentication\AuthenticationService;

/**
 * This is the factory class for NavManager service. The purpose of the factory
 * is to instantiate the service and pass it dependencies (inject dependencies).
 */
class NavManagerFactory
{
    /**
     * This method creates the NavManager service and returns its instance. 
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {        
        $authService = new AuthenticationService();
        
        $viewHelperManager = $container->get('ViewHelperManager');
        $urlHelper = $viewHelperManager->get('url');
        $rbacManager = $container->get(RbacManager::class);
        
        return new NavManager($authService, $urlHelper, $rbacManager);
    }
}
