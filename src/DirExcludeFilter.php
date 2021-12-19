<?php

declare(strict_types=1);

namespace Softwarewisdom\DirMonitor;

use SplFileInfo;

/**
 *
 */
class DirExcludeFilter extends FileInfoFilter
{
    /**
     * @var SplFileInfo
     */
    private $fileInfo;
    /**
     * @var array<string>
     */
    private $dirExclude;
    /**
     * @var FileInfoFilter
     */
    private $filter;

    /**
     * @param SplFileInfo $fileInfo
     * @param array<string> $dirExclude
     * @param FileInfoFilter $filter
     */
    public function __construct(SplFileInfo $fileInfo, array $dirExclude, FileInfoFilter $filter)
    {
        $this->fileInfo = $fileInfo;
        $this->dirExclude = $dirExclude;
        $this->filter = $filter;
    }

    /**
     * @param FileVisitor $visitor
     * @return bool
     */
    public function accept(FileVisitor $visitor): bool
    {
        return $visitor->forDir($this->fileInfo, $this->dirExclude, $this->filter);
    }
}
