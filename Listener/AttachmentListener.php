<?php

namespace Akuma\Bundle\CoenFileBundle\Listener;

use Akuma\Bundle\CoenFileBundle\Entity\Attachment;
use Akuma\Bundle\CoenFileBundle\Manager\AttachmentManager;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class AttachmentListener
{
    /** @var AttachmentManager */
    protected $attachmentManager;

    /**
     * @param AttachmentManager $attachmentManager
     */
    public function __construct(AttachmentManager $attachmentManager)
    {
        $this->attachmentManager = $attachmentManager;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        /** @var Attachment $entity */
        $entity = $args->getEntity();

        $this->uploadFile($entity);
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        /** @var Attachment $entity */
        $entity = $args->getEntity();

        $this->uploadFile($entity);
    }

    /**
     * @param Attachment $entity
     */
    private function uploadFile($entity)
    {
        // upload only works for Product entities
        if (!$entity instanceof Attachment) {
            return;
        }

        $file = $entity->getFile();

        // only upload new files
        if ($file instanceof UploadedFile) {
            $fileName = $this->attachmentManager->upload($file);
            $entity->setFilename($fileName);
        }
    }
}
