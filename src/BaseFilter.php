<?php

declare(strict_types=1);

namespace Softwarewisdom\DirMonitor;

class BaseFilter extends FileInfoFilter
{
    public function accept(FileVisitor $visitor): bool
    {
        return $visitor->forBase();
    }
}
