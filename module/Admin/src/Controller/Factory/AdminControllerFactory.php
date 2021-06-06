<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonAdmin for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Admin\Controller\Factory;

use Admin\Controller\AdminController;
use Admin\Service\ServiceManager;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class AdminControllerFactory implements FactoryInterface 
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
        $authService = $container->get(\Laminas\Authentication\AuthenticationService::class);
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $serviceManager = $container->get(ServiceManager::class);
        //$entityManager = $container->get (\Doctrine\ORM\EntityManager::class);

        return new AdminController($authService,$entityManager,$serviceManager);
    }

}