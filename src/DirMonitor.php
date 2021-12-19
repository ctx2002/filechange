<?php

declare(strict_types=1);

namespace Softwarewisdom\DirMonitor;

use Generator;
use SplFileInfo;

/**
 *
 */
class DirMonitor
{
    /**
     * @var string
     */
    private $dir;
    /**
     * @var array{exclude_dir?:array<string>}
     */
    private $configs;

    /** @var array<string, int>*/
    private $fileHash = [];

    /**
     * @param string $dir
     * @param array{exclude_dir?:array<string>} $configs
     */
    public function __construct(string $dir, array $configs = [])
    {
        $this->dir = $dir;
        $this->configs = $configs;
        if (isset($this->configs['exclude_dir']) === false) {
            $this->configs['exclude_dir'] = [];
        }
    }

    /**
     * @return Generator<string>
     */
    public function scan(): Generator
    {
        $iterator = FilterBuildFactory::buildIterator($this->dir, $this->configs);
        /** @var SplFileInfo $fileInfo*/
        foreach ($iterator as $fileInfo) {
            if ($fileInfo->getRealPath() !== false) {
                if (isset($this->fileHash[$fileInfo->getRealPath()]) === true) {
                    if ($this->fileHash[$fileInfo->getRealPath()] !== $fileInfo->getMTime()) {
                        $this->fileHash[$fileInfo->getRealPath()] = $fileInfo->getMTime();
                        yield $fileInfo->getRealPath();
                    }
                } else {
                    $this->fileHash[$fileInfo->getRealPath()] = $fileInfo->getMTime();
                    yield $fileInfo->getRealPath();
                }
            }
        }
    }
}
