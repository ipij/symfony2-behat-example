<?php
namespace App\ModuleNotebook\Bundle\ModuleNotebookBundle\Security\Voter;

use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\InvalidArgumentException;
use Symfony\Component\Security\Core\User\UserInterface;

class NotebookSecurityVoter implements VoterInterface
{

    const ACTION_LIST   = 'notebook.list';
    const ACTION_VIEW   = 'notebook.view';
    const ACTION_CREATE = 'notebook.create';
    const ACTION_UPDATE = 'notebook.update';
    const ACTION_DELETE = 'notebook.delete';

    /**
     *
     * @var \App\ModuleObjectsBundle\Model\MapObjectAclModel
     */
    public $mapObjectAclModel;

    public function getSupportedAttributes()
    {
        return array(
            self::ACTION_LIST,
            self::ACTION_VIEW,
            self::ACTION_CREATE,
            self::ACTION_UPDATE,
            self::ACTION_DELETE
        );
    }

    public function supportsAttribute($attribute)
    {
        return in_array($attribute, $this->getSupportedAttributes());
    }

    public function supportsClass($class)
    {
        $supportedClass = 'App\ModuleNotebook\Bundle\ModuleNotebookBundle\Entity\Notebook';
        
        return $supportedClass === $class || is_subclass_of($class, $supportedClass);
    }

    /**
     *
     * @param \App\ModuleNotebook\Bundle\ModuleNotebookBundle\Entity\Notebook $object            
     */
    public function vote(TokenInterface $token, $object, array $attributes)
    {
        // check if the voter is used correct, only allow one attribute
        // this isn't a requirement, it's just one easy way for you to
        // design your voter
        if (1 !== count($attributes)) {
            throw new InvalidArgumentException('Only one attribute is allowed.');
        }
        
        // set the attribute to check against
        $attribute = $attributes[0];
        
        // check if the given attribute is covered by this voter
        if (! $this->supportsAttribute($attribute)) {
            return VoterInterface::ACCESS_ABSTAIN;
        }
        
        // check if class of this object is supported by this voter
        if (null !== $object && ! $this->supportsClass(get_class($object))) {
            return VoterInterface::ACCESS_ABSTAIN;
        }
        
        // get current logged in user
        $user = $token->getUser();
        
        // make sure there is a user object (i.e. that the user is logged in)
        if (! $user instanceof UserInterface) {
            return VoterInterface::ACCESS_DENIED;
        }
        
        switch ($attribute) {
            case self::ACTION_LIST:
                return VoterInterface::ACCESS_GRANTED;
            
            case self::ACTION_CREATE:
                return VoterInterface::ACCESS_GRANTED;
            
            case self::ACTION_VIEW:
            case self::ACTION_UPDATE:
            case self::ACTION_DELETE:
                if (null !== $object) {
                    if(null !== $object->getOwner()
                        && $object->getOwner()->getId() === $token->getUser()->getId()) {
                        return VoterInterface::ACCESS_GRANTED;
                    }
                }
                
                break;
        }
        
        return VoterInterface::ACCESS_DENIED;
    }
}
