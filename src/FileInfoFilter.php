<?php

declare(strict_types=1);

namespace Softwarewisdom\DirMonitor;

abstract class FileInfoFilter
{
    abstract public function accept(FileVisitor $visitor): bool;
}
