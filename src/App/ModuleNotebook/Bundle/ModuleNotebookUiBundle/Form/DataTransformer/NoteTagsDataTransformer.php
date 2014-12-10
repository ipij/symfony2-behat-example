<?php

namespace App\ModuleNotebook\Bundle\ModuleNotebookUiBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;

use App\ModuleNotebook\Bundle\ModuleNotebookBundle\Entity\NoteTag;
use App\ModuleNotebook\Bundle\ModuleNotebookBundle\Model\NoteTagModel;

class NoteTagsDataTransformer implements DataTransformerInterface
{
    /**
     * @var \App\ModuleNotebook\Bundle\ModuleNotebookBundle\Model\NoteTagModel 
     */
    protected $modelNoteTag;
    
    public function __construct(NoteTagModel $modelNoteTag) {
        $this->modelNoteTag = $modelNoteTag;
    }
    
	/* (non-PHPdoc)
     * @see \Symfony\Component\Form\DataTransformerInterface::transform()
     */
    public function transform($value)
    {
        $results = [];
		foreach($value as $item) {
			if($item instanceof NoteTag) {
				$results[] = $item->getName();
			}
		}
		
		return implode(', ', $results);
    }

	/* (non-PHPdoc)
     * @see \Symfony\Component\Form\DataTransformerInterface::reverseTransform()
     */
    public function reverseTransform($value)
    {
        if(!is_string($value))
			return [];
		
		$resultsRaw = explode(',', $value);
		$resultsRaw = array_map(function($row) {
		    return trim($row);
		}, $resultsRaw);
	    $resultsRaw = array_filter($resultsRaw, function($row) {
	       return '' != $row;
	    });
		
		$results = [];
		foreach ($resultsRaw as $result) {
		    $entity = $this->modelNoteTag->createOrGetTag($result);
		    $results[] = $entity;
		}
		
		return $results;
    }

}
