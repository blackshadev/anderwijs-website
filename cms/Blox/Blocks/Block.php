<?php

namespace Blox\Blocks;

use Blox\BlockManager\BlockManagerInterface;
use Blox\Result\ResultInterface;
use craft\elements\MatrixBlock;

abstract class Block implements BlockInterface
{
    use WithTypeHandle;
    private BlockManagerInterface $blockManager;

    public abstract function map(MatrixBlock $block): ResultInterface;

    public function accepts(MatrixBlock $block): bool
    {
        return $this->matchTypeHandle($block);
    }

    public function getBlockManager(): BlockManagerInterface
    {
        return $this->blockManager;
    }

    public function setBlockManager(BlockManagerInterface $blockManager): void
    {
        $this->blockManager = $blockManager;
    }
}
