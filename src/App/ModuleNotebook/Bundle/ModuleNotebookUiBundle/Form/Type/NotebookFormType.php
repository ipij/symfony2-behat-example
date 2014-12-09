<?php
namespace App\ModuleNotebook\Bundle\ModuleNotebookUiBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NotebookFormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', 'text', [
            'label' => 'Notebook name',
            'required' => true,
        ]);
        
        $builder->add('submit', 'submit', [
            'label' => 'Submit',
        ]);
    }

    public function getName()
    {
        return 'notebook';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array());
    }
}
