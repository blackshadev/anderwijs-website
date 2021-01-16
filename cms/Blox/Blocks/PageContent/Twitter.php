<?php

namespace Blox\Blocks\PageContent;

use Blox\Blocks\Block;
use Blox\Result\ArrayResult;
use Blox\Result\ResultInterface;
use craft\elements\MatrixBlock;

class Twitter extends Block
{
    public function map(MatrixBlock $block): ResultInterface
    {
        return ArrayResult::fromArray('TwitterFeed', [
            'id' => $block->id,
            'handle' => $block->twitterHandle,
            'sourceType' => $block->twitterSourceType->value,
            'limit' => $block->twitterLimit
        ]);
    }
}
