<?php
namespace Admin\Controller\Factory;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Admin\Controller\PermissionController;
use Admin\Service\PermissionManager;

/**
 * This is the factory for PermissionController. Its purpose is to instantiate the
 * controller and inject dependencies into it.
 */
class PermissionControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $permissionManager = $container->get(PermissionManager::class);
        
        // Instantiate the controller and inject dependencies
        return new PermissionController($entityManager, $permissionManager);
    }
}



