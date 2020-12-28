<?php

namespace Blox\BlockManager;

use Blox\Blocks\BlockInterface;
use Blox\Result\ResultInterface;
use craft\elements\db\MatrixBlockQuery;
use craft\elements\MatrixBlock;

class BlockManager implements BlockManagerInterface
{
    public static function create(): BlockManagerInterface {
        return new static();
    }

    /** @var BlockInterface[] */
    private array $blocks = [];

    public function map(MatrixBlockQuery $items): array
    {
        $blocks = [];

        foreach ($items as $item) {
            $block = $this->mapSingle($item);
            $blocks[] = $block;
        }

        return $blocks;
    }

    public function register(BlockInterface $block): BlockManagerInterface
    {
        $this->blocks[] = $block;
        $block->setBlockManager($this);
        return $this;
    }

    protected function mapSingle(MatrixBlock $item): ResultInterface
    {
        foreach ($this->blocks as $block) {
            if($block->accepts($item)) {
                return $block->map($item);
            }
        }

        throw new \UnexpectedValueException('Unexpected matrix block, got type ' . $item->getType()->handle);
    }
}
