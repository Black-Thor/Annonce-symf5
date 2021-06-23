<?php

namespace App\Form;

use App\Entity\NewAnnonces;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnnoncesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',null, [
            'label'=>'Titre'])
            ->add('description')
            ->add('Telephone')
            ->add('codePostal',null, [
        'label'=>'Code Postal'])
            ->add('date')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => NewAnnonces::class,
        ]);
    }
}
