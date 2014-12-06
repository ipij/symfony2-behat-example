<?php

namespace App\ModuleNotebook\Component\Notebook\Model;

/**
 * Note Tag interface.
 *
 */
interface NoteTagInterface
{
	/**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     */
    public function setName($name);
    
	/**
     * @return string
     */
    public function getSlug();

	/**
     * @param string $slug
     */
    public function setSlug($slug);
}
