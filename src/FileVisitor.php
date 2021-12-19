<?php

declare(strict_types=1);

namespace Softwarewisdom\DirMonitor;

use SplFileInfo;

/**
 *
 */
interface FileVisitor
{
    /**
     * @param SplFileInfo $fileInfo
     * @param array<string> $dirExclude
     * @param FileInfoFilter $filter
     * @return bool
     */
    public function forDir(SplFileInfo $fileInfo, array $dirExclude, FileInfoFilter $filter): bool;

    /**
     * @param SplFileInfo $fileInfo
     * @param FileInfoFilter $filter
     * @return bool
     */
    public function forNonPHPFile(SplFileInfo $fileInfo, FileInfoFilter $filter): bool;

    /**
     * @return bool
     */
    public function forBase(): bool;
}
