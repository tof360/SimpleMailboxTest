<?php

namespace App\Form;

use App\Entity\Mail;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('subject')
            ->add('sendTo', EntityType::class, [
                // each entry in the array will be an "email" field
                'class' => User::class,
                // these options are passed to each "email" type
                'multiple' => true,
                'choice_label' => 'email',
            ])
            ->add('body', TextareaType::class)
            ->add('save', SubmitType::class, [
                'attr' => ['class' => 'save btn-secondary'],
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Mail::class,
        ]);
    }
}
