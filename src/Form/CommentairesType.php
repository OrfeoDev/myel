<?php

namespace App\Form;

use App\Entity\Commentaires;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentairesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email',EmailType::class,[
                'label'=> ' Votre email',
                'attr'=>[
                    'class'=> 'form_control'
                ]
            ])
            ->add('pseudo',TextType::class,[
                'label'=> ' Votre pseudo',
                'attr'=>[
                    'class'=> 'form_control'
                ]
            ])
            ->add('contenu', TextType::class,[
                'label'=> ' Votre descriprion',
                'attr'=>[
                    'class'=> 'form_control'
                ]
            ])
            ->add('rgpd',CheckboxType::class)
            ->add('envoyez',SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commentaires::class,
        ]);
    }
}
