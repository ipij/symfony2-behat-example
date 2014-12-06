<?php

namespace App\ModuleNotebook\Component\Notebook\Model;

/**
 * Note Tag model.
 *
 */
class NoteTag implements NoteTagInterface
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
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

	/**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    
	/**
	 * {@inheritdoc}
	 */
    public function getName()
    {
        return $this->name;
    }

    /**
	 * {@inheritdoc}
	 */
    public function setName($name)
    {
        $this->name = $name;
    }
    
	/**
	 * {@inheritdoc}
	 */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * {@inheritdoc}
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }
}
