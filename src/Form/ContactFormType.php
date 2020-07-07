<?php


namespace App\Form;

use phpDocumentor\Reflection\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactFormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, [
                    'label' => 'name',
                ])
            ->add('email', EmailType::class)
            ->add('hiddenInput', EmailType::class, [
                'attr'=> ['autocomplete' => 'off'],
                'required' => false,
            ])
            ->add('content', TextareaType::class, [
                'label' => 'content'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
    }

}
