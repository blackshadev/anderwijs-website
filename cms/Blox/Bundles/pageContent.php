<?php

return \Blox\BlockManager\RowBasedBlockManager::create()
    ->register(\Blox\Blocks\PageContent\RichText::byTypeHandle('richtext'))
    ->register(\Blox\Blocks\PageContent\Row::byTypeHandle('row'))
    ->register(\Blox\Blocks\PageContent\Image::byTypeHandle('image'))
    ->register(\Blox\Blocks\PageContent\CallToAction::byTypeHandle('callToAction'));
