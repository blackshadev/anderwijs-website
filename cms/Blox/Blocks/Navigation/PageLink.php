<?php

namespace Blox\Blocks\Navigation;

use Blox\Blocks\Block;
use Blox\Result\ArrayResult;
use Blox\Result\EmptyResult;
use Blox\Result\ResultInterface;
use craft\elements\MatrixBlock;

class PageLink extends Block
{
    public function map(MatrixBlock $block): ResultInterface
    {
        $page = $block->page->one();
        if (!$page) {
            return new EmptyResult();
        }
        return ArrayResult::fromArray('pageLink', [
            'id' => $block->id,
            'page' => $page->slug,
            'title' => $page->title,
        ]);
    }
}
