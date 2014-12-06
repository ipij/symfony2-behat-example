<?php

namespace App\ModuleNotebook\Bundle\ModuleNotebookBundle\Entity;

/**
 * Note tag model.
 *
 */
class NoteTag
{
    /**
     * 
     * @var mixed
     */
    protected $id;
    
    /**
     * 
     * @var string
     */
    protected $name;

    /**
     *
     * @var string
     */
    protected $slug;
    
	/**
     * @return the $name
     */
    public function getName()
    {
        return $this->name;
    }

	/**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

	/**
     * @return the $slug
     */
    public function getSlug()
    {
        return $this->slug;
    }

	/**
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }
}
