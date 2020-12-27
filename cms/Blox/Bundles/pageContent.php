<?php

return \Blox\BlockManager\BlockManager::create()
    ->register(\Blox\Blocks\PageContent\RichText::byTypeHandle('textBlock'));
