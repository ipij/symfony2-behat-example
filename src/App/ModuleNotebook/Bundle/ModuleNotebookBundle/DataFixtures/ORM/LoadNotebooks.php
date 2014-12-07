<?php

namespace App\ModuleNotebook\Bundle\ModuleNotebookBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

use App\ModuleNotebook\Bundle\ModuleNotebookBundle\Entity\Notebook;

class LoadNotebooks extends AbstractFixture implements 
    DependentFixtureInterface,
    ContainerAwareInterface
{

    /**
     *
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getDependencies()
    {
        return [
            'App\ModuleUser\Bundle\ModuleUserApiBundle\DataFixtures\ORM\LoadUsersSampleData',
        ];
    }
    
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $model = $this->container->get('app_module_notebook.model.notebook');
        
        $entity = new Notebook();
        $entity->setName('Shopping list');
        $entity->setOwner($this->getReference('user:Greg'));
        $model->save($entity);
        $this->setReference(sprintf('notebook:%s:%s', $entity->getOwner()->getUsername(), $entity->getName()), $entity);
        
        $entity = new Notebook();
        $entity->setName('Todo list');
        $entity->setOwner($this->getReference('user:Greg'));
        $model->save($entity);
        $this->setReference(sprintf('notebook:%s:%s', $entity->getOwner()->getUsername(), $entity->getName()), $entity);
        
        $entity = new Notebook();
        $entity->setName('Todo list');
        $entity->setOwner($this->getReference('user:Katie'));
        $model->save($entity);
        $this->setReference(sprintf('notebook:%s:%s', $entity->getOwner()->getUsername(), $entity->getName()), $entity);
    }
}
