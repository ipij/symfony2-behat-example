<?php

namespace App\ModuleNotebook\Bundle\ModuleNotebookBundle\Entity;

/**
 * Note tag model.
 *
 */
class Notebook
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
     *
     * @var \App\ModuleUser\Bundle\ModuleUserBundle\Entity
     */
    protected $owner;

    /**
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
    }
    
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
    
	/**
     * @return \App\ModuleUser\Bundle\ModuleUserBundle\Entity
     */
    public function getOwner()
    {
        return $this->owner;
    }

	/**
     * @param \App\ModuleUser\Bundle\ModuleUserBundle\Entity $owner
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;
    }
}
