<?php

namespace Akuma\Bundle\CoenFileBundle\Form\Type;

use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AttachmentCollectionType extends AbstractType
{
    const NAME = 'coen_attachment_collection';

    /** @var string */
    protected $dataClass;

    /**
     * @inheritDoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('files', CollectionType::class, [
            'entry_type'   => AttachmentType::class,
            'allow_add' => true,
            'prototype' => true,
            'attr'         => [
                'class' => "files-collection",
            ],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->getBlockPrefix();
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return self::NAME;
    }

    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);
    }
}
