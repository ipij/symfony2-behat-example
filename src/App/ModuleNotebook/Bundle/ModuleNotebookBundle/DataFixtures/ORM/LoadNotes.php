<?php

namespace App\ModuleNotebook\Bundle\ModuleNotebookBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

use App\ModuleNotebook\Bundle\ModuleNotebookBundle\Entity\Note;

class LoadNotes extends AbstractFixture implements 
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
            'App\ModuleNotebook\Bundle\ModuleNotebookBundle\DataFixtures\ORM\LoadNotebooks',
            'App\ModuleNotebook\Bundle\ModuleNotebookBundle\DataFixtures\ORM\LoadTags',
        ];
    }
    
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $model = $this->container->get('app_module_notebook.model.note');
        $modelTag = $this->container->get('app_module_notebook.model.noteTag');

        $entity = new Note();
        $entity->setNotebook($this->getReference(sprintf('notebook:%s:%s', 'Katie', 'Todo list')));
        $entity->setSubject('Close window at home');
//         $entity->getTags()->add($this->getReference(sprintf('noteTag:%s', 'home')));
        $entity->getTags()->add($modelTag->createOrGetTag('At home'));
        $model->save($entity);
        
        $entity = new Note();
        $entity->setNotebook($this->getReference(sprintf('notebook:%s:%s', 'Greg', 'Shopping list')));
        $entity->setSubject('Food for cat');
//         $entity->getTags()->add($this->getReference(sprintf('noteTag:%s', 'kitty')));
        $entity->getTags()->add($modelTag->createOrGetTag('Kitty'));
//         $entity->getTags()->add($this->getReference(sprintf('noteTag:%s', 'food')));
        $entity->getTags()->add($modelTag->createOrGetTag('Food'));
        $model->save($entity);

        $entity = new Note();
        $entity->setNotebook($this->getReference(sprintf('notebook:%s:%s', 'Greg', 'Shopping list')));
        $entity->setSubject('Food for cat');
//         $entity->getTags()->add($this->getReference(sprintf('noteTag:%s', 'doggy')));
        $entity->getTags()->add($modelTag->createOrGetTag('Doggy'));
//         $entity->getTags()->add($this->getReference(sprintf('noteTag:%s', 'food')));
        $entity->getTags()->add($modelTag->createOrGetTag('Food'));
        $model->save($entity);

        $entity = new Note();
        $entity->setNotebook($this->getReference(sprintf('notebook:%s:%s', 'Greg', 'Shopping list')));
        $entity->setSubject('Cheese');
//         $entity->getTags()->add($this->getReference(sprintf('noteTag:%s', 'food')));
        $entity->getTags()->add($modelTag->createOrGetTag('Food'));
//         $entity->getTags()->add($this->getReference(sprintf('noteTag:%s', 'home')));
        $entity->getTags()->add($modelTag->createOrGetTag('At home'));
        $model->save($entity);

        $entity = new Note();
        $entity->setNotebook($this->getReference(sprintf('notebook:%s:%s', 'Greg', 'Todo list')));
        $entity->setSubject('Write corporate scenarios at home');
//         $entity->getTags()->add($this->getReference(sprintf('noteTag:%s', 'work')));
        $entity->getTags()->add($modelTag->createOrGetTag('Food'));
//         $entity->getTags()->add($this->getReference(sprintf('noteTag:%s', 'home')));
        $entity->getTags()->add($modelTag->createOrGetTag('At home'));
        $model->save($entity);
        
    }
}
