<?php

namespace Blox\Blocks;

use Blox\Result\ResultInterface;
use craft\elements\MatrixBlock;

abstract class Block implements BlockInterface
{
    use WithTypeHandle;

    public abstract function map(MatrixBlock $block): ResultInterface;

    public function accepts(MatrixBlock $block): bool
    {
        return $this->matchTypeHandle($block);
    }
}
