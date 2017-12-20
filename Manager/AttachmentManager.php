<?php

namespace Akuma\Bundle\CoenFileBundle\Manager;

use Symfony\Component\HttpFoundation\File\File;

class AttachmentManager
{
    /** @var string */
    protected $targetDir;

    /** @var int */
    protected $allowedCount = 3;

    /**
     * Returns moved file name
     *
     * @param File $file
     *
     * @return string
     */
    public function upload(File $file)
    {
        $fileName = uniqid('file_', true);
        $file->move($this->getTargetDir(), $fileName);

        return $fileName;
    }

    /**
     * @return int
     */
    public function getAllowedCount()
    {
        return $this->allowedCount ?: 3;
    }

    /**
     * @param int $allowedCount
     *
     * @return $this
     */
    public function setAllowedCount($allowedCount)
    {
        $this->allowedCount = $allowedCount ?: 3;

        return $this;
    }

    /**
     * @return string
     */
    public function getTargetDir()
    {
        return $this->targetDir;
    }

    /**
     * @param string $targetDir
     *
     * @return $this
     */
    public function setTargetDir($targetDir)
    {
        if (!is_dir($targetDir)) {
            mkdir($targetDir);
        }

        if (!is_writable($targetDir)) {
            throw new \Exception(sprintf('Target dir "%s" should be writable', $targetDir));
        }

        $this->targetDir = $targetDir;

        return $this;
    }
}
