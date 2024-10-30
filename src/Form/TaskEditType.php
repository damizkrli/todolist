<?php

namespace App\Form;

use App\Entity\Task;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class TaskEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => false,
            ])
            ->add('description', TextareaType::class, [
                'label' => false,
                'attr' => [
                    'rows' => 7,
                ]
            ])
            ->add('category', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Work, Personal...',
                ]
            ])
            ->add('status', ChoiceType::class, [
                'choices'     => [
                    'Standby' => Task::STATUS_PENDING,
                    'In progress'   => Task::STATUS_PROGRESS,
                    'Finished'      => Task::STATUS_FINISHED,
                ],
                'label' => false,
                'placeholder' => "Choose status",
                'required'    => false,
            ])
            ->add('users', EntityType::class, [
                'class'        => User::class,
                'choice_label' => function (User $user) {
                    return $user->getFirstname() . ' ' . $user->getLastname();
                },
                'multiple'     => true,
                'expanded'     => true,
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
