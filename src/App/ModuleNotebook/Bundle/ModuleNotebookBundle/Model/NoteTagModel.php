<?php
namespace App\ModuleNotebook\Bundle\ModuleNotebookBundle\Model;

use AppCommon\CommonModelBundle\Model\BaseDoctrineEntityModel;
use App\ModuleNotebook\Bundle\ModuleNotebookBundle\Entity\NoteTag;

/**
 * 
 * @author Athlan
 *
 */
class NoteTagModel extends BaseDoctrineEntityModel
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
    
    public function createOrGetTag($tagname) {
        $entity = $this->getRepository()->findOneByName($tagname);
        
        if(null === $entity) {
            $entity = new NoteTag();
            $entity->setName($tagname);
        }
        
        return $entity;
    }
}
