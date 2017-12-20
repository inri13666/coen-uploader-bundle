<?php

namespace Akuma\Bundle\CoenFileBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    const CONFIG_NODE = 'akuma_coen_file';
    const TARGET_DIR_NODE = 'target_dir';
    const MAX_UPLOADS_NODE = 'max_uploads';

    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();

        $treeBuilder->root(self::CONFIG_NODE)
            ->children()
                ->scalarNode(self::TARGET_DIR_NODE)
                    ->defaultValue(sys_get_temp_dir())
                    ->beforeNormalization()
                        ->always()
                        ->then(function($v) {
                            return is_dir($v)&&is_writable($v) ? $v: sys_get_temp_dir();
                        })
                    ->end()
                ->end()
                ->integerNode(self::MAX_UPLOADS_NODE)
                    ->defaultValue(3)
                    ->beforeNormalization()
                        ->always()
                        ->then(function($v) {
                            return (int)$v ?: 3;
                        })
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
