<?php

namespace App\Form;

use App\Entity\Task;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('category')
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'En attente' => Task::STATUS_PENDING,
                    'En cours' => Task::STATUS_PROGRESS,
                    'Finie' => Task::STATUS_FINISHED,
                ],
                'placeholder' => "Choisir le statut",
                "data" => Task::STATUS_PENDING,
                'required'    => false,
                'multiple' => false,
            ])
            ->add('priority', ChoiceType::class, [
                'choices' => [
                    'Basse' => Task::PRIORITY_LOW,
                    'Moyenne' => Task::PRIORITY_MEDIUM,
                    'Haute' => Task::PRIORITY_HIGH,
                ],
                'placeholder' => "Choisir la priorité",
                "data" => Task::PRIORITY_MEDIUM,
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
            ->add('updatedAt', DateType::class, [
                'widget' => 'single_text',
                'html5' => true,
                'required' => false,
            ])
            ->add('users', EntityType::class, [
                'class' => User::class,
                'choice_label' => function (User $user) {
                    return $user->getFirstname() . ' ' . $user->getLastname();
                },
                'multiple' => true, // Permet de sélectionner plusieurs utilisateurs
                'expanded' => true, // Affiche les utilisateurs sous forme de cases à cocher
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
        ]);
    }
}
