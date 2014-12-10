<?php
namespace App\ModuleNotebook\Bundle\ModuleNotebookUiBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Symfony\Component\Validator\Constraints as Assert;

class NoteFormType extends AbstractType
{

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
            'format' => 'yyyy-MM-dd HH:mm:ss',
            'constraints' => [
            ],
        ]);
        
//         $builder->add('tags', 'text', [
//             'label' => 'Tags',
//             'constraints' => [
//                 new Assert\NotBlank(),
//             ],
//         ]);
        
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
