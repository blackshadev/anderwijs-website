<?php

namespace Blox\Blocks\PageContent;

use Blox\Blocks\Block;
use Blox\Result\ArrayResult;
use Blox\Result\ResultInterface;
use craft\elements\MatrixBlock;

class Image extends Block
{
    public function map(MatrixBlock $block): ResultInterface
    {
        $image = $block->image->one();
        return ArrayResult::fromArray('image', [ 'id' => $block->id, 'url' => $image->url, 'title' => $image->title ]);
    }
}
