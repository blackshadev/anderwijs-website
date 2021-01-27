<?php

namespace Blox\Blocks\PageContent;

use Blox\Blocks\Block;
use Blox\Result\ArrayResult;
use Blox\Result\ResultInterface;
use craft\elements\MatrixBlock;

class YoutubeVideo extends Block
{
    public function map(MatrixBlock $block): ResultInterface
    {
        return ArrayResult::fromArray('YoutubeVideo', [
            'id' => $block->id,
            'videoId' => $block->youtubeVideoId
        ]);
    }
}
