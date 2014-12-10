<?php
namespace App\ModuleNotebook\Bundle\ModuleNotebookUiBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Symfony\Component\Validator\Constraints as Assert;
use App\ModuleNotebook\Bundle\ModuleNotebookUiBundle\Form\DataTransformer\NoteTagsDataTransformer;

class NoteFormType extends AbstractType
{
    /**
     * @var \App\ModuleNotebook\Bundle\ModuleNotebookUiBundle\Form\DataTransformer\NoteTagsDataTransformer 
     */
    protected $noteTagsDataTransformer;
    
    public function __construct(NoteTagsDataTransformer $noteTagsDataTransformer) {
        $this->noteTagsDataTransformer = $noteTagsDataTransformer;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('subject', 'text', [
            'label' => 'Subject',
            'required' => true,
            'constraints' => [
                new Assert\NotBlank(),
            ],
        ]);

        $builder->add('contents', 'textarea', [
            'label' => 'Contents',
            'constraints' => [
            ],
        ]);

        $builder->add('dueDate', 'datetime', [
            'label' => 'Due date',
            'widget' => 'single_text',
            'format' => 'yyyy-MM-dd',
            'constraints' => [
            ],
        ]);

        $builder->add('tags', 'text', [
            'label' => 'Tags',
            'attr' => [
                'placeholder' => 'type tags here',
            ],
        ]);
        $builder->get('tags')->addModelTransformer($this->noteTagsDataTransformer);
        
        $builder->add('submit', 'submit', [
            'label' => 'Submit',
        ]);
    }
    
    public function getName()
    {
        return 'note';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array());
    }
}
