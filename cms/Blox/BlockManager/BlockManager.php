<?php

namespace Blox\BlockManager;

use Blox\Blocks\BlockInterface;
use Blox\Result\ResultInterface;
use craft\elements\db\MatrixBlockQuery;
use craft\elements\MatrixBlock;

class BlockManager implements BlockManagerInterface
{
    public static function create(): self {
        return new self();
    }

    /** @var BlockInterface[] */
    private array $blocks = [];

    public function map(MatrixBlock $item): ?ResultInterface
    {
        foreach ($this->blocks as $block) {
            if($block->accepts($item)) {
                return $block->map($item);
            }
        }

        return null;
    }

    public function mapMany(MatrixBlockQuery $items): array
    {
        $blocks = [];

        foreach ($items as $item) {
            $block = $this->map($item);
            if ($block !== null) {
                $blocks[] = $block;
            }
        }

        return $blocks;
    }

    public function register(BlockInterface $block): BlockManagerInterface
    {
        $this->blocks[] = $block;
        $block->setBlockManager($this);
        return $this;
    }
}
