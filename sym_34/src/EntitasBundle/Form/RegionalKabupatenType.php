<?php

namespace EntitasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class RegionalKabupatenType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('idKabupaten',Type\IntegerType::class,
            [
                'label'=>'ID Kecamatan',
                'attr'=>
                [
                    'class'=>'form-control form-control-sm',
                    'placeholder'=>'ID Kabupaten'
                ] 
            ])
        ->add('namaKabupaten',Type\TextType::class,
            [
                'label'=>'Nama Kecamatan',
                'attr'=>
                [
                    'class'=>'form-control form-control-sm',
                    'placeholder'=>'ID Kabupaten'
                ] 
            ])
        ->add('typeKabupaten',Type\TextType::class,
            [
                'label'=>'Type Kabupaten',
                'attr'=>
                [
                    'class'=>'form-control form-control-sm',
                    'placeholder'=>'ID Kabupaten'
                ] 
            ])
        ->add('kodePos',Type\TextType::class,
            [
                'label'=>'Kode POS',
                'attr'=>
                [
                    'class'=>'form-control form-control-sm',
                    'placeholder'=>'ID Kabupaten'
                ] 
            ])
        ->add('propinsis',EntityType::class,
            [
                'label'=>'Propinsi',
                'class' => 'EntitasBundle:RegionalPropinsi',
                'choice_label'=>'namapropinsi',
                'multiple' => false,'expanded' => false,
                'attr'=>['class'=>'form-control form-control-sm','placeholder'=>'Nama Lengkap','required'=>true]
            ]);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EntitasBundle\Entity\RegionalKabupaten'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'entitasbundle_regionalkabupaten';
    }


}
