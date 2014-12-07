<?php

namespace App\ModuleUser\Bundle\ModuleUserApiBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use App\ModuleUser\Bundle\ModuleUserBundle\Entity\UserEntity;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

class LoadUsersSampleData extends AbstractFixture implements 
    // DependentFixtureInterface,
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
    
    // /**
    // * {@inheritDoc}
    // */
    // public function getDependencies()
    // {
    // return [];
    // }
    
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $model = $this->container->get('app_module_user.model.user');
        
        $entity = $model->findOneByUsername("Administrator");
        if (null === $entity) {
            $entity = new UserEntity();
            $entity->setEnabled(true);
            $entity->setUsername("Administrator");
            $entity->setEmail("admin@example.com");
            $entity->setPlainPassword("a");
            $entity->setRoles([
                'ROLE_ADMIN'
            ]);
            $model->save($entity);
        }
        $this->setReference(sprintf('user:%s', $entity->getUsername()), $entity);
        
        $entity = $model->findOneByUsername("Greg");
        if (null === $entity) {
            $entity = new UserEntity();
            $entity->setEnabled(true);
            $entity->setUsername("Greg");
            $entity->setEmail("greg@example.com");
            $entity->setPlainPassword("a");
            $entity->setRoles([
                'ROLE_USER'
            ]);
            $model->save($entity);
        }
        $this->setReference(sprintf('user:%s', $entity->getUsername()), $entity);
        
        $entity = $model->findOneByUsername("Katie");
        if (null === $entity) {
            $entity = new UserEntity();
            $entity->setEnabled(true);
            $entity->setUsername("Katie");
            $entity->setEmail("user2@example.com");
            $entity->setPlainPassword("a");
            $entity->setRoles([
                'ROLE_USER'
            ]);
            $model->save($entity);
        }
        $this->setReference(sprintf('user:%s', $entity->getUsername()), $entity);
    }
}
