<?php

namespace Blox\Blocks\Navigation;

use Blox\Blocks\Block;
use Blox\Result\ArrayResult;
use Blox\Result\ResultInterface;
use craft\elements\MatrixBlock;

class PageLink extends Block
{
    public function map(MatrixBlock $block): ResultInterface
    {
        return ArrayResult::fromArray('pageLink', ['page' => $block->page->one()->slug ]);
    }
}
