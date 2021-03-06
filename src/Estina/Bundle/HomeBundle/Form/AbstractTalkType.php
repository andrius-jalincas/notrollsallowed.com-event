<?php

namespace Estina\Bundle\HomeBundle\Form;

use Estina\Bundle\HomeBundle\Entity\Talk;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

abstract class AbstractTalkType extends AbstractType
{
    protected $tshirtSizes = ['XS', 'S', 'M', 'L', 'XL', 'XXL', 'XXXL'];

    protected $tshirtModels = ['unisex' => 'registration.form.tshirt_unisex',
        'women' => 'registration.form.tshirt_women'];
    protected $talkTypes = ['registration.form.type_presentation', 'registration.form.type_workshop',
        'registration.form.type_other'];
    protected $campDates = [
        '07-24' => 'registration.form.camp_date_1',
        '07-25' => 'registration.form.camp_date_2',
        '07-26' => 'registration.form.camp_date_3',
        '07-27' => 'registration.form.camp_date_4',
        '07-28' => 'registration.form.camp_date_5'];
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', 'choice', [
                'label' => 'registration.form.type',
                'choices' => array_combine(Talk::getTypesMap(), $this->talkTypes),
            ])
            ->add('title', 'text', [
                'label' => 'registration.form.name',
            ])
            ->add('language', 'choice', [
                'label' => 'registration.form.language',
                'choices' => ['LT' => 'LT', 'EN' => 'EN'],
            ])
            ->add('description', 'textarea', [
                'label' => 'registration.form.description',
            ])
            ->add('requirements', 'textarea', [
                'label' => 'registration.form.requirements',
                'required' => false,
            ])
            ->add('comments', 'textarea', [
                'label' => 'registration.form.comments',
                'required' => false,
            ])
            ->add('question1', 'choice', [
                'label' => 'registration.form.question1',
                'choices' => $this->campDates,
            ])
            ->add('tshirtModel', 'choice', [
                'label' => 'registration.form.tshirt',
                'choices' =>  $this->tshirtModels,
            ])
            ->add('tshirtSize', 'choice', [
                'label' => 'registration.form.tshirt_size',
                'choices' => array_combine($this->tshirtSizes, $this->tshirtSizes),
            ])
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Estina\Bundle\HomeBundle\Entity\Talk'
        ));
    }
}
