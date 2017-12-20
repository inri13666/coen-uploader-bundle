<?php

namespace Akuma\Bundle\CoenFileBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class AkumaCoenFileExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        if($container->hasDefinition('akuma_coen_file.manager.attachement')){
            $definition = $container->getDefinition('akuma_coen_file.manager.attachement');
            $definition->addMethodCall('setTargetDir', [$config[Configuration::TARGET_DIR_NODE]]);
            $definition->addMethodCall('setAllowedCount', [$config[Configuration::MAX_UPLOADS_NODE]]);
        }
    }
}
