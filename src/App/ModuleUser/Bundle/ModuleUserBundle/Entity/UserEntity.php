<?php

namespace App\ModuleUser\Bundle\ModuleUserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * @ORM\Entity(repositoryClass="AppCommon\CommonModelBundle\Repository\BaseDoctrineEntityRepository")
 * @ORM\Table(name="users")
 */
class UserEntity extends BaseUser
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
}
