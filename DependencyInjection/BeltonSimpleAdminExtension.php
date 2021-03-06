<?php

namespace Belton\SimpleAdminBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class BeltonSimpleAdminExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('manager.yml');
        $loader->load('forms.yml');
        $loader->load('events.yml');
        
        if(!isset($config['forms']) or !isset($config['forms']['crop'])){
            $container->setParameter('belton_simple_admin.forms.crop', array());
        } else {
            $container->setParameter('belton_simple_admin.forms.crop', $config['forms']['crop']);
        }

        $container->setParameter('belton_simple_admin.manager.menu', $config['menu']);
        $container->setParameter('belton_simple_admin.manager.infos', array(
            'website' => $config['website'],
            'backlink' => $config['backlink']
        ));
        $container->setParameter('belton_simple_admin.manager.registration', $config['registration']);
    }
}
