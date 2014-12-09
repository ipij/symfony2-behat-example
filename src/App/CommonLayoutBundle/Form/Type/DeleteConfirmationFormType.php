<?php
namespace App\CommonLayoutBundle\Form\Type;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DeleteConfirmationFormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('confirm', 'submit', [
            'label' => 'Confirm'
        ]);
        
        $builder->add('cancel', 'submit', [
            'label' => 'Cancel'
        ]);
    }

    public function getName()
    {
        return 'commonDeleteConfirmation';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array());
    }

    public function isConfirmed()
    {
        var_dump($form->container->get('request')->get($form->getName()));
    }

    public function isCanceled()
    {
        return ! $this->isConfirmed();
    }
}
