<?php

namespace AppBundle\Behat\Context;

use Behat\Behat\Context\Context;
use Behat\Symfony2Extension\Context\KernelAwareContext;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\KernelInterface;

use Symfony\Bridge\Doctrine\DataFixtures\ContainerAwareLoader as DataFixturesLoader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;

/**
 * 
 * @author Athlan
 *
 */
class DoctrineFixturesContext implements Context, KernelAwareContext
{
    /**
     * @var KernelInterface
     */
    protected $kernel;
    
    public function __construct()
    {
        //$this->faker = FakerFactory::create();
    }
    
    /**
     * {@inheritdoc}
     */
    public function setKernel(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }
    
    /**
     * Returns Container instance.
     *
     * @return ContainerInterface
     */
    protected function getContainer()
    {
        return $this->kernel->getContainer();
    }
    
    /**
     * @BeforeScenario
     */
    public function loadFixturesBeforeScenarios() {
        $paths = array();
        foreach ($this->kernel->getBundles() as $bundle) {
            $paths[] = $bundle->getPath().'/DataFixtures/ORM';
        }
        
        $loader = new DataFixturesLoader($this->getContainer());
        foreach ($paths as $path) {
            if (is_dir($path)) {
                $loader->loadFromDirectory($path);
            }
        }
        
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');
        $fixtures = $loader->getFixtures();
        $purger = new ORMPurger($em);
        //$purger->setPurgeMode($input->getOption('purge-with-truncate') ? ORMPurger::PURGE_MODE_TRUNCATE : ORMPurger::PURGE_MODE_DELETE);
        $purger->setPurgeMode(ORMPurger::PURGE_MODE_DELETE);
        $executor = new ORMExecutor($em, $purger);
//         $executor->setLogger(function($message) use ($output) {
//             $output->writeln(sprintf('  <comment>></comment> <info>%s</info>', $message));
//         });
        $append = false;
        $executor->execute($fixtures, $append);
    }
}
