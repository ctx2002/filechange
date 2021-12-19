<?php

declare(strict_types=1);

namespace Softwarewisdom\DirMonitor;

use SplFileInfo;

/**
 *
 */
class PHPFileFilter extends FileInfoFilter
{
    /**
     * @var SplFileInfo
     */
    private $fileInfo;
    /**
     * @var FileInfoFilter
     */
    private $filter;

    /**
     * @param SplFileInfo $fileInfo
     */
    public function __construct(SplFileInfo $fileInfo, FileInfoFilter $infoFilter)
    {
        $this->fileInfo = $fileInfo;
        $this->filter = $infoFilter;
    }

    /**
     * @param FileVisitor $visitor
     * @return bool
     */
    public function accept(FileVisitor $visitor): bool
    {
        return $visitor->forNonPHPFile($this->fileInfo, $this->filter);
    }
}
