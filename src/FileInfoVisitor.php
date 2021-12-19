<?php

declare(strict_types=1);

namespace Softwarewisdom\DirMonitor;

use SplFileInfo;

/**
 *
 */
class FileInfoVisitor implements FileVisitor
{
    /**
     * @param SplFileInfo $fileInfo
     * @param array<string> $dirExclude
     * @param FileInfoFilter $filter
     * @return bool
     */
    public function forDir(SplFileInfo $fileInfo, array $dirExclude, FileInfoFilter $filter): bool
    {
        $b = $filter->accept($this);
        if ($fileInfo->isDir() === true) {
            $b = in_array($fileInfo->getFilename(), $dirExclude, true);
        }

        return  $b;
    }

    /**
     * @param SplFileInfo $fileInfo
     * @param FileInfoFilter $filter
     * @return bool
     */
    public function forNonPHPFile(SplFileInfo $fileInfo, FileInfoFilter $filter): bool
    {
        $b = $filter->accept($this);
        if ($fileInfo->isFile() === true) {
            $b = strtolower($fileInfo->getExtension()) !== 'php';
        }
        return  $b;
    }

    /**
     * @return bool
     */
    public function forBase(): bool
    {
        return true;
    }
}
