<?php

namespace App\ModuleNotebook\Bundle\ModuleNotebookBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

use App\ModuleNotebook\Bundle\ModuleNotebookBundle\Entity\NoteTag;

class LoadTags extends AbstractFixture implements 
    //DependentFixtureInterface,
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
    
//     /**
//      * {@inheritDoc}
//      */
//     public function getDependencies()
//     {
//         return [
//         ];
//     }
    
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
//         $model = $this->container->get('app_module_notebook.model.noteTag');

//         $entity = new NoteTag();
//         $entity->setName('Doggy');
//         $model->save($entity);
//         $this->setReference(sprintf('noteTag:%s', $entity->getSlug()), $entity);
        
//         $entity = new NoteTag();
//         $entity->setName('Kitty');
//         $model->save($entity);
//         $this->setReference(sprintf('noteTag:%s', $entity->getSlug()), $entity);

//         $entity = new NoteTag();
//         $entity->setName('Food');
//         $model->save($entity);
//         $this->setReference(sprintf('noteTag:%s', $entity->getSlug()), $entity);
        
//         $entity = new NoteTag();
//         $entity->setName('Work');
//         $model->save($entity);
//         $this->setReference(sprintf('noteTag:%s', $entity->getSlug()), $entity);
        
//         $entity = new NoteTag();
//         $entity->setName('Home');
//         $model->save($entity);
//         $this->setReference(sprintf('noteTag:%s', $entity->getSlug()), $entity);
    }
}
