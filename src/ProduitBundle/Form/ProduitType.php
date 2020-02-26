<?php

namespace ProduitBundle\Form;

use Doctrine\DBAL\Types\FloatType;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ProduitType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom', null, ['label'=> false, 'attr' => ['class'=> 'form-control form-control-user', 'id'=> 'nom']])
            ->add('imageFile', VichImageType::class, ['label'=> false, 'allow_delete'=>false])
            ->add('quantite', null, ['label'=> false, 'attr' => ['class'=> 'form-control form-control-user', 'id'=> 'quantite']])
            ->add('prix', IntegerType::class, ['label'=> false, 'attr' => ['type'=> 'number', 'class'=> 'form-control form-control-user']])
        ->add('categorie', EntityType::class, ['class'=> 'ProduitBundle:Categorie', 'label'=> false]);
           // ->add('imageFile');
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
