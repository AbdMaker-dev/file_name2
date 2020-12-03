<?php

namespace Container7RmQOWM;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getApiProviderService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'App\DataProvider\ApiProvider' shared autowired service.
     *
     * @return \App\DataProvider\ApiProvider
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/DataProvider/RestrictedDataProviderInterface.php';
        include_once \dirname(__DIR__, 4).'/src/DataProvider/ApiProvider.php';

        return $container->privates['App\\DataProvider\\ApiProvider'] = new \App\DataProvider\ApiProvider(($container->services['doctrine'] ?? $container->getDoctrineService()), ($container->privates['api_platform.doctrine.orm.query_extension.pagination'] ?? $container->load('getApiPlatform_Doctrine_Orm_QueryExtension_PaginationService')), new RewindableGenerator(function () use ($container) {
            yield 0 => ($container->privates['api_platform.doctrine.orm.query_extension.eager_loading'] ?? $container->load('getApiPlatform_Doctrine_Orm_QueryExtension_EagerLoadingService'));
        }, 1), ($container->privates['App\\Repository\\ProfileRepository'] ?? $container->load('getProfileRepositoryService')), ($container->privates['App\\Repository\\UserRepository'] ?? $container->load('getUserRepositoryService')));
    }
}