<?php

namespace ProduitBundle\Form;

use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom', null, ['label'=> false, 'attr' => ['class'=> 'form-control form-control-user']])
            ->add('file')
            ->add('quantite', null, ['label'=> false, 'attr' => ['class'=> 'form-control form-control-user']])
            ->add('prix', null, ['label'=> false, 'attr' => ['class'=> 'form-control form-control-user']])
        ->add('categorie', EntityType::class, ['class'=> 'ProduitBundle:Categorie']);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ProduitBundle\Entity\Produit'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'produitbundle_produit';
    }


}
