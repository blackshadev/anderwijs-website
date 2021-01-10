<?php

namespace Blox\Blocks\PageContent;

use Blox\Blocks\Block;
use Blox\Result\ArrayResult;
use Blox\Result\ResultInterface;
use craft\elements\MatrixBlock;

class CallToAction extends Block
{
    public function map(MatrixBlock $block): ResultInterface
    {
        return new ArrayResult('callToAction', [
            'title' => $block->ctaTitle,
            'subTitle' => $block->ctaSubtitle,
            'image' => $block->image->one()->url,
            'imageDimensionRatio' => $block->image->one()->height / $block->image->one()->width,
            'buttons' => array_map(fn ($item) => [
                'title' => $item->ctaButtonTitle,
                'page' => $item->ctaButtonPage->exists() ? $item->ctaButtonPage->one()->slug : null
            ], $block->ctaButtons->all())
        ]);
    }
}
