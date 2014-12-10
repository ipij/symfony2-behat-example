<?php

namespace App\ModuleNotebook\Bundle\ModuleNotebookBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
/**
 * Note model.
 *
 */
class Note
{
    /**
     *
     * @var mixed
     */
    protected $id;

    /**
     *
     * @var Notebook
     */
    protected $notebook;
    
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
     * @var Collection|NoteTag
     */
    protected $tags;
    
    public function __construct() {
        $this->creationDate = new \DateTime();
        $this->tags = new ArrayCollection();
    }
    
    /**
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
    }

	/**
     * @return the $notebook
     */
    public function getNotebook()
    {
        return $this->notebook;
    }
    
    /**
     * @param \App\ModuleNotebook\Bundle\ModuleNotebookBundle\Entity\Notebook $notebook
     */
    public function setNotebook($notebook)
    {
        $this->notebook = $notebook;
    }
    
	/**
     * @return the $subject
     */
    public function getSubject()
    {
        return $this->subject;
    }

	/**
     * @param string $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

	/**
     * @return the $contents
     */
    public function getContents()
    {
        return $this->contents;
    }

	/**
     * @param string $contents
     */
    public function setContents($contents)
    {
        $this->contents = $contents;
    }

	/**
     * @return the $creationDate
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

	/**
     * @param DateTime $creationDate
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;
    }

	/**
     * @return the $completeDate
     */
    public function getCompleteDate()
    {
        return $this->completeDate;
    }

	/**
     * @param DateTime $completeDate
     */
    public function setCompleteDate($completeDate)
    {
        $this->completeDate = $completeDate;
    }

	/**
     * @return the $dueDate
     */
    public function getDueDate()
    {
        return $this->dueDate;
    }

	/**
     * @param DateTime $dueDate
     */
    public function setDueDate($dueDate)
    {
        $this->dueDate = $dueDate;
    }
    
	/**
     * @return the $tags
     */
    public function getTags()
    {
        return $this->tags;
    }

	/**
     * @param Collection|\App\ModuleNotebook\Bundle\ModuleNotebookBundle\Entity\NoteTag $tags
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    }
}
