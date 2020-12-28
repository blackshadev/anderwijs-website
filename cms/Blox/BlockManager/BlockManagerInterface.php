<?php

namespace Blox\BlockManager;

use Blox\Blocks\BlockInterface;
use craft\elements\db\MatrixBlockQuery;

interface BlockManagerInterface {
    public function map(MatrixBlockQuery $block): array;
    public function register(BlockInterface $block): self;
}
