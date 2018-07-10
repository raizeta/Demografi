<?php

namespace EntitasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type;
class RegionalKecamatanType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('idKecamatan',Type\IntegerType::class,
            [
                'label'=>'ID Kecamatan',
                'attr'=>
                [
                    'class'=>'form-control form-control-sm',
                    'placeholder'=>'ID Kecamatan'
                ] 
            ])
        ->add('namaKecamatan',Type\TextType::class,
            [
                'label'=>'Nama Kecamatan',
                'attr'=>
                [
                    'class'=>'form-control form-control-sm',
                    'placeholder'=>'Nama Kecamatan'
                ] 
            ])
        ->add('kodePos',Type\TextType::class,
            [
                'label'=>'Kode Pos',
                'attr'=>
                [
                    'class'=>'form-control form-control-sm',
                    'placeholder'=>'Kode Pos'
                ] 
            ])
        ->add('kabupatens',EntityType::class,
                [
                    'class' => 'EntitasBundle:RegionalKabupaten',
                    'choice_label'=>'namaKabupaten',
                    'multiple' => false,'expanded' => false,
                    'attr'=>['class'=>'form-control form-control-sm','placeholder'=>'Nama Lengkap','required'=>true]
                ]
             );
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EntitasBundle\Entity\RegionalKecamatan'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'entitasbundle_regionalkecamatan';
    }


}
