<?php

namespace ContainerMxnTj8H;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_ZsLJzdService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.zs_LJzd' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.zs_LJzd'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService, [
            'apiService' => ['privates', 'App\\Services\\ApiService', 'getApiServiceService', true],
            'em' => ['services', 'doctrine.orm.default_entity_manager', 'getDoctrine_Orm_DefaultEntityManagerService', false],
            'repo_brief' => ['privates', 'App\\Repository\\BriefRepository', 'getBriefRepositoryService', true],
            'repo_etaBrief' => ['privates', 'App\\Repository\\EtatBriefRepository', 'getEtatBriefRepositoryService', true],
            'repo_forma' => ['privates', 'App\\Repository\\FormateurRepository', 'getFormateurRepositoryService', true],
            'repo_groupe' => ['privates', 'App\\Repository\\GroupeRepository', 'getGroupeRepositoryService', true],
            'repo_niv' => ['privates', 'App\\Repository\\NiveauRepository', 'getNiveauRepositoryService', true],
            'repo_tag' => ['privates', 'App\\Repository\\TagsRepository', 'getTagsRepositoryService', true],
            'serializer' => ['services', 'serializer', 'getSerializerService', false],
            'validate' => ['services', 'validator', 'getValidatorService', false],
        ], [
            'apiService' => 'App\\Services\\ApiService',
            'em' => '?',
            'repo_brief' => 'App\\Repository\\BriefRepository',
            'repo_etaBrief' => 'App\\Repository\\EtatBriefRepository',
            'repo_forma' => 'App\\Repository\\FormateurRepository',
            'repo_groupe' => 'App\\Repository\\GroupeRepository',
            'repo_niv' => 'App\\Repository\\NiveauRepository',
            'repo_tag' => 'App\\Repository\\TagsRepository',
            'serializer' => '?',
            'validate' => '?',
        ]);
    }
}
