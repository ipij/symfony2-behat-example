<?php
namespace App\ModuleNotebook\Bundle\ModuleNotebookBundle\Model;

use AppCommon\CommonModelBundle\Model\BaseDoctrineEntityModel;

/**
 * 
 * @author Athlan
 *
 */
class NoteModel extends BaseDoctrineEntityModel
{

    public function getList(array $params)
    {
        $q = $this->getRepository()->createQueryBuilder('item');
        
        if (isset($params['excludeIds']) && is_array($params['excludeIds'])) {
            $q->andWhere($q->expr()
                ->notIn('item.id', $params['excludeIds']));
        }

        if (isset($params['notebook']) && $params['notebook']) {
            if(! is_array($params['notebook'])) {
                $params['notebook'] = array($params['notebook']);
            }
            
            $q->andWhere($q->expr()
                ->in('item.notebook', $params['notebook']));
        }
        
        if (isset($params['returnQuery']) && $params['returnQuery']) {
            return $q->getQuery();
        }
        
        if (isset($params['returnQueryBuilder']) && $params['returnQueryBuilder']) {
            return $q;
        }
        
        return $q->getQuery()->getResult();
    }
}
