<?php

namespace Recruiter\EmployerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EmployerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('employer_name')
            ->add('employer_description')
            ->add('location')
            ->add('address')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Recruiter\EmployerBundle\Entity\Employer'
        ));
    }

    public function getName()
    {
        return 'recruiter_employerbundle_employertype';
    }
}
