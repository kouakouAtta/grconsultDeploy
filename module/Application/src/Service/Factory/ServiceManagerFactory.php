<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Service\Factory;

use Application\Controller\IndexController;
use Application\Service\ServiceManager;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class ServiceManagerFactory implements FactoryInterface 
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
        //$authService = $container->get(\Zend\Authentication\AuthenticationService::class);
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        //$entityManager = $container->get (\Doctrine\ORM\EntityManager::class);

        return new ServiceManager($entityManager);
    }

}