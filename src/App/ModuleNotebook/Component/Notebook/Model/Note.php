<?php

namespace App\ModuleNotebook\Component\Notebook\Model;

use Doctrine\Common\Collections\Collection;

/**
 * Note model.
 * 
 */
class Note implements NoteInterface
{
    /**
     * 
     * @var string
     */
    protected $subject;
    
    /**
     * 
     * @var string
     */
    protected $contents;
    
    /**
     * 
     * @var \DateTime
     */
    protected $creationDate;

    /**
     *
     * @var \DateTime
     */
    protected $completeDate;

    /**
     *
     * @var \DateTime
     */
    protected $dueDate;
    
    /**
     * 
     * @var Collection|NoteTagInterface[]
     */
    protected $tags;
    
	/**
	 * {@inheritdoc}
	 */
    public function getSubject()
    {
        return $this->subject;
    }
    
	/**
	 * {@inheritdoc}
	 */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }
    
	/**
	 * {@inheritdoc}
	 */
    public function getContents()
    {
        return $this->contents;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setContents($contents)
    {
        $this->contents = $contents;
    }
    
	/**
	 * {@inheritdoc}
	 */
    public function getCreationDate()
    {
        return $this->creationDate;
    }
    
	/**
	 * {@inheritdoc}
	 */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;
    }
    
	/**
	 * {@inheritdoc}
	 */
    public function getCompleteDate()
    {
        return $this->completeDate;
    }
    
	/**
	 * {@inheritdoc}
	 */
    public function setCompleteDate($completeDate)
    {
        $this->completeDate = $completeDate;
    }
    
	/**
	 * {@inheritdoc}
	 */
    public function getDueDate()
    {
        return $this->dueDate;
    }
    
	/**
	 * {@inheritdoc}
	 */
    public function setDueDate($dueDate)
    {
        $this->dueDate = $dueDate;
    }
    
	/**
	 * {@inheritdoc}
	 */
    public function getTags()
    {
        return $this->tags;
    }
    
	/**
	 * {@inheritdoc}
	 */
    public function setTags($tags)
    {
        $this->tags = $tags;
    }

}
