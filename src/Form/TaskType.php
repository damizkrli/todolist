<?php

namespace App\Form;

use App\Entity\Task;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Name',
                'attr' => [
                    'placeholder' => 'Something to do...'
                ]
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'attr' => [
                    'placeholder' => 'This is the description...',
                    'rows' => 7,
                ]
            ])
            ->add('category', TextType::class, [
                'label' => 'Category',
                'attr' => [
                    'placeholder' => 'Work, Personal...',
                ]
            ])
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'Waiting' => Task::STATUS_PENDING,
                    'In progress' => Task::STATUS_PROGRESS,
                    'Finish' => Task::STATUS_FINISHED,
                ],
                'placeholder' => "Choose status",
                'data' => Task::STATUS_PENDING,
                'required'    => false,
                'multiple' => false,
            ])
            ->add('priority', ChoiceType::class, [
                'choices' => [
                    'Low' => Task::PRIORITY_LOW,
                    'Medium' => Task::PRIORITY_MEDIUM,
                    'High' => Task::PRIORITY_HIGH,
                ],
                'placeholder' => "Choose priority",
                'data' => Task::PRIORITY_MEDIUM,
                'required'    => false,
                'multiple' => false,
            ])
            ->add('limitDate', DateType::class, [
                'widget' => 'single_text',
                'html5' => true,
            ])
            ->add('createdAt', DateType::class, [
                'widget' => 'single_text',
                'html5' => true,
            ])
            ->add('users', EntityType::class, [
                'class' => User::class,
                'choice_label' => function (User $user) {
                    return $user->getFirstname() . ' ' . $user->getLastname();
                },
                'multiple' => true,
                'expanded' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
        ]);
    }
}
