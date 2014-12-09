<?php
namespace App\ModuleNotebook\Bundle\ModuleNotebookBundle\Model;

use AppCommon\CommonModelBundle\Model\BaseDoctrineEntityModel;

/**
 * 
 * @author Athlan
 *
 */
class NotebookModel extends BaseDoctrineEntityModel
{

    /**
     * 
     * @param string $slug
     * @param int $userId
     */
    public function getBySlugAndUser($slug, $userId)
    {
        return $this->getRepository()->findOneBy([
            'slug' => $slug,
            'owner' => $userId,
        ]);
    }
    
    public function getList(array $params)
    {
        $q = $this->getRepository()->createQueryBuilder('item');

        if (isset($params['excludeIds']) && is_array($params['excludeIds'])) {
            $q->andWhere($q->expr()
                ->notIn('item.id', $params['excludeIds']));
        }

        if (isset($params['ownerId'])) {
            $q->andWhere($q->expr()
                ->eq('item.owner', $params['ownerId']));
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
