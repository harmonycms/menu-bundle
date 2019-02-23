<?php

namespace Harmony\Bundle\MenuBundle\Form\Type;

use Harmony\Bundle\MenuBundle\Entity\MenuItem;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class MenuItemType
 *
 * @package Harmony\Bundle\MenuBundle\Form\Type
 */
class MenuItemType extends AbstractType
{

    /**
     * Builds the form.
     * This method is called for each type in the hierarchy starting from the
     * top most type. Type extensions can further modify the form.
     *
     * @see FormTypeExtensionInterface::buildForm()
     *
     * @param FormBuilderInterface $builder The form builder
     * @param array                $options The options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title')->add('url')->add('active')->add('target', ChoiceType::class, [
            'choices' => ['Même fenetre' => '_self', 'Nouvelle fenetre' => '_blank'],
            'label'   => 'Ouverture'
        ]);
    }

    /**
     * Configures the options for this type.
     *
     * @param OptionsResolver $resolver The resolver for the options
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault('data_class', MenuItem::class);
    }
}