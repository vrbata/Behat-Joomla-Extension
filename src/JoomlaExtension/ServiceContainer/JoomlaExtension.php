<?php

namespace Symla\Behat\JoomlaExtension\ServiceContainer;

use Symla\Joomla\Cli\CliBootstrap;
use Behat\Behat\Context\ServiceContainer\ContextExtension;
use Behat\Testwork\ServiceContainer\Extension;
use Behat\Testwork\ServiceContainer\ExtensionManager;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Exception\ParameterNotFoundException;

class JoomlaExtension implements Extension
{
    /**
     * {@inheritdoc}
     */
    public function getConfigKey()
    {
        return 'joomla';
    }

    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        //
    }

    /**
     * {@inheritdoc}
     */
    public function initialize(ExtensionManager $extensionManager)
    {
        //
    }

    /**
     * {@inheritdoc}
     */
    public function configure(ArrayNodeDefinition $builder)
    {
        $builder
            ->children()
                ->scalarNode('base_url')
                    ->defaultNull()
                ->end()
                ->scalarNode('base_path')
                    ->isRequired()
                ->end()
            ->end();
    }

    /**
     * {@inheritdoc}
     */
    public function load(ContainerBuilder $container, array $config)
    {
        $minksBaseUrl = null;
        try {
            $minksBaseUrl = $container->getParameter('mink.base_url');
        } catch (ParameterNotFoundException $exception) {

        }

        $joomlasBaseUrl = $config['base_url'];

        $config['base_url'] = $minksBaseUrl ? $minksBaseUrl : $joomlasBaseUrl;

        $this->loadJoomla($config);
        $this->loadContextInitializer($container);

        $container->setParameter('joomla.parameters', $config);
    }

    private function loadContextInitializer(ContainerBuilder $container)
    {
        $definition = new Definition('Symla\Behat\JoomlaExtension\Context\Initializer\JoomlaAwareInitializer', ['%joomla.parameters%']);

        $definition->addTag(ContextExtension::INITIALIZER_TAG, ['priority' => 0]);
        $container->setDefinition('joomla.context_initializer', $definition);
    }

    /**
     * Boot up Joomla
     */
    private function loadJoomla(array $config)
    {
        define('SYMLA_PATH_ROOT', $config['base_path']);

        CliBootstrap::bootstrap();
    }
}