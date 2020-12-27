<?php

namespace Blox\Blocks;

use Blox\Result\ResultInterface;
use craft\elements\MatrixBlock;

interface BlockInterface
{
    public function accepts(MatrixBlock $block): bool;
    public function map(MatrixBlock $block): ResultInterface;
}
