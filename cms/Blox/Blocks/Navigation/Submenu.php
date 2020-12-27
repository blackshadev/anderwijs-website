<?php

namespace Blox\Blocks\Navigation;

use Blox\Blocks\Block;
use Blox\Result\ArrayResult;
use Blox\Result\ResultInterface;
use craft\elements\MatrixBlock;

class Submenu extends Block
{
    public function map(MatrixBlock $block): ResultInterface
    {
        $submenu = $block->submenu->one();
        return ArrayResult::fromArray('submenu', [
            'title' => $submenu->title,
            'items' => $this->getBlockManager()->mapMany($submenu->navigationitems)
        ]);
    }
}
