<?php

namespace Blox\BlockManager;

use Blox\Blocks\BlockInterface;
use Blox\Result\ResultInterface;
use craft\elements\db\MatrixBlockQuery;
use craft\elements\MatrixBlock;

interface BlockManagerInterface {
    public function map(MatrixBlock $block): ?ResultInterface;
    public function mapMany(MatrixBlockQuery $block): array;
    public function register(BlockInterface $block): self;
}
