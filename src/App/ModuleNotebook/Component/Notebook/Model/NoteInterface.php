<?php

namespace App\ModuleNotebook\Component\Notebook\Model;

use Doctrine\Common\Collections\Collection;

/**
 * Note interface.
 *
 */
interface NoteInterface
{
	/**
     * @return string
     */
    public function getSubject();
    
	/**
     * @param string $subject
     */
    public function setSubject($subject);
    
	/**
     * @return string
     */
    public function getContents();
    
	/**
     * @param string $contents
     */
    public function setContents($contents);
    
	/**
     * @return \DateTime
     */
    public function getCreationDate();
    
	/**
     * @param \DateTime $creationDate
     */
    public function setCreationDate($creationDate);
    
	/**
     * @return \DateTime
     */
    public function getCompleteDate();
    
	/**
     * @param \DateTime $completeDate
     */
    public function setCompleteDate($completeDate);
    
	/**
     * @return \DateTime
     */
    public function getDueDate();
    
	/**
     * @param \DateTime $dueDate
     */
    public function setDueDate($dueDate);
    
	/**
     * @return Collection|NoteTagInterface[]
     */
    public function getTags();
    
	/**
     * @param Collection|NoteTagInterface[] $tags
     */
    public function setTags($tags);

}
