<?php

namespace Container7RmQOWM;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_Gf0y2HJService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.Gf0y2HJ' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.Gf0y2HJ'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService, [
            'apiService' => ['privates', 'App\\Services\\ApiService', 'getApiServiceService', true],
            'em' => ['services', 'doctrine.orm.default_entity_manager', 'getDoctrine_Orm_DefaultEntityManagerService', false],
            'serializer' => ['services', 'serializer', 'getSerializerService', false],
        ], [
            'apiService' => 'App\\Services\\ApiService',
            'em' => '?',
            'serializer' => '?',
        ]);
    }
}
