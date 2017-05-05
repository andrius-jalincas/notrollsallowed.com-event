<?php

namespace Estina\Bundle\HomeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Estina\Bundle\HomeBundle\Entity\Talk;

/**
 * Register talk.
 */
class RegisterTalkType extends AbstractType
{
    private $addUser = true;

    private $tshirtSizes = ['XS', 'S', 'M', 'L', 'XL', 'XXL', 'XXXL'];

    private $tshirtModels = ['unisex', 'women'];

    public function __construct($addUser = true)
    {
        $this->addUser = $addUser;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if ($this->addUser) {
            $builder->add('user', new UserType(), ['label' => false]);
        }
        $builder
            ->add('type', 'choice', [
                'label' => 'Type of presentation',
                'choices' => Talk::getTypesMap(),
            ])
            ->add('title', 'text', [
                'label' => 'Complete title',
            ])
            ->add('language', 'choice', [
                'label' => 'Presentation language',
                'choices' => ['LT' => 'LT', 'EN' => 'EN'],
            ])
            ->add('description', 'textarea', [
                'label' => 'Talk description',
            ])
            ->add('requirements', 'textarea', [
                'label' => 'Requirements for attendees',
                'required' => false,
            ])
            ->add('track', null, [
                'label' => 'Stage', 
                'required' => false,
            ])
            ->add('comments', 'textarea', [
                'label' => 'Comments/special requests',
                'required' => false,
            ])
            ->add('tshirtModel', 'choice', [
                'label' => 'T-shirt model',
                'choices' => array_combine(
                    $this->tshirtModels, array_map("ucfirst", $this->tshirtModels)),
            ])
            ->add('tshirtSize', 'choice', [
                'label' => 'T-shirt size',
                'choices' => array_combine($this->tshirtSizes, $this->tshirtSizes),
            ])
            ->add('question1', 'text', [
                'label' => 'What can you teach other No Trolls Allowed attendees in 5 minutes?',
            ])
            ->add('question2', 'text', [
                'label' => 'How can you contribute to No Trolls Allowed event?',
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

    /**
     * @return string
     */
    public function getName()
    {
        return 'estina_bundle_homebundle_registertalk';
    }
}
