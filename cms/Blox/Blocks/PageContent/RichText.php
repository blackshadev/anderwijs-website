<?php

namespace Blox\Blocks\PageContent;

use Blox\Blocks\Block;
use Blox\Result\ArrayResult;
use Blox\Result\ResultInterface;
use craft\elements\MatrixBlock;

class RichText extends Block
{
    public function map(MatrixBlock $block): ResultInterface
    {
        return ArrayResult::fromArray('RichText', [ 'id' => $block->id, 'body' => $block->body ]);
    }
}
