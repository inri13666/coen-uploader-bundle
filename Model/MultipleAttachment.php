<?php

namespace Akuma\Bundle\CoenFileBundle\Model;

use Akuma\Bundle\CoenFileBundle\Entity\Attachment;

class MultipleAttachment
{
    protected $files = [];

    /**
     * @return array
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * @param array $files
     *
     * @return $this
     */
    public function setFiles(array $files = [])
    {
        $this->files = $files;

        return $this;
    }

    /**
     * @return \Generator
     */
    public function getAttachments()
    {
        foreach ($this->files as $file) {
            yield (new Attachment())->setFile($file);
        }
    }
}
