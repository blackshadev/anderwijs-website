<?php

return \Blox\BlockManager\BlockManager::create()
    ->register(Blox\Blocks\Navigation\ExternalLink::byTypeHandle('external'))
    ->register(Blox\Blocks\Navigation\PageLink::byTypeHandle('page'))
    ->register(Blox\Blocks\Navigation\Submenu::byTypeHandle('submenu'));
