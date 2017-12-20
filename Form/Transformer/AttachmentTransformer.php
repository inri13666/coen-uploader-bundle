<?php

namespace Akuma\Bundle\CoenFileBundle\Form\Transformer;

use Akuma\Bundle\CoenFileBundle\Entity\Attachment;
use Symfony\Component\Form\DataTransformerInterface;

class AttachmentTransformer implements DataTransformerInterface
{
    /**
     * @inheritDoc
     */
    public function transform($value)
    {
        if ($value instanceof Attachment) {
            return $value->getId();
        }
    }

    /**
     * @inheritDoc
     */
    public function reverseTransform($value)
    {
    }
}
