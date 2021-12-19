<?php

declare(strict_types=1);

namespace Softwarewisdom\DirMonitor;

use FilesystemIterator;
use RecursiveCallbackFilterIterator;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use RuntimeException;

/**
 *
 */
class FilterBuildFactory
{
    /**
     * @param string $dir
     * @param array{exclude_dir?:array<string>} $configs
     * @return RecursiveIteratorIterator<RecursiveCallbackFilterIterator>
     * @throws RuntimeException
     */
    public static function buildIterator(string $dir, array $configs): RecursiveIteratorIterator
    {
        if (isset($configs['exclude_dir']) === false) {
            throw new RuntimeException("must set exclude_dir");
        }

        $directory = new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS);
        $files = new RecursiveCallbackFilterIterator($directory, function ($fileInfo, $key, $iterator) use ($configs) {
            $b = (
                new DirExcludeFilter(
                    $fileInfo,
                    $configs['exclude_dir'],
                    new PHPFileFilter($fileInfo, new BaseFilter())
                )
            )->accept(new FileInfoVisitor());
            return !$b;
        });
        return new RecursiveIteratorIterator($files);
    }
}
