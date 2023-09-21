<?php

namespace App\Form;

use App\Entity\Application;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ApplicationType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
    $builder
      ->add('lastname', TextType::class, ['label' => 'Nom'])
      ->add('firstname', TextType::class, ['label' => 'Prénom'])
      ->add('city', TextType::class, ['label' => 'Ville'])
      ->add('email', EmailType::class)
      ->add('Envoyer', SubmitType::class)
      // ->add('offer')
    ;
  }

  public function configureOptions(OptionsResolver $resolver): void
  {
    $resolver->setDefaults([
      'data_class' => Application::class,
    ]);
  }
}
