<?php
namespace App\ModuleUser\Bundle\ModuleUserBundle\Model;

use AppCommon\CommonModelBundle\Model\BaseDoctrineEntityModel;

/**
 * 
 * @author Athlan
 *
 */
class UserModel extends BaseDoctrineEntityModel
{

    public function getList(array $params)
    {
        $q = $this->getRepository()->createQueryBuilder('item');
        
        if (isset($params['excludeIds']) && is_array($params['excludeIds'])) {
            $q->andWhere($q->expr()
                ->notIn('item.id', $params['excludeIds']));
        }
        
        if (isset($params['returnQueryBuilder']) && $params['returnQueryBuilder']) {
            return $q;
        }
        
        return $q->getQuery()->getResult();
    }
}
