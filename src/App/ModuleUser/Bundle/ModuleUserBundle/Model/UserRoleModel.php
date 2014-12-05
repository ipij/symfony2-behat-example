<?php
namespace App\ModuleUser\Bundle\ModuleUserBundle\Model;

use AppCommon\CommonModelBundle\Model\BaseDoctrineEntityModel;

/**
 * 
 * @author Athlan
 *
 */
class UserRoleModel extends BaseDoctrineEntityModel
{

    protected $roles = array(
        array(
            'role' => 'ROLE_USER',
            'isDefault' => true
        ),
        array(
            'role' => 'ROLE_MERCHANT'
        ),
        array(
            'role' => 'ROLE_ADMIN'
        )
    );

    public function getList(array $params = [])
    {
        $roles = $this->roles;
        
        if (isset($params['defaultRoles']) && $params['defaultRoles'] === false) {
            $roles = array_filter($roles, function ($row)
            {
                return ! isset($row['isDefault']) || $row['isDefault'] === false;
            });
        }
        
        return array_map(function ($row)
        {
            return $row['role'];
        }, $roles);
    }
}
