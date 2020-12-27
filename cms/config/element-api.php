<?php

use craft\elements\Entry;

return [
    'endpoints' => [
        'navigation.json' => function() {

            return [
                'elementType' => Entry::class,
                'criteria' => ['section' => 'navigation'],
                'transformer' => function(Entry $entry) {

                    $item = $entry->item->one();
                    $type = $item->getType()->handle;
                    /** @var \Blox\BlockManager\BlockMangerInterface $blockMapper */
                    $blockMapper = Craft::$container->get('navigation');

                    return [
                        'parent' => null,
                        'title' => $entry->title,
                        'slug' => $entry->slug,
                        'item' => $blockMapper->mapMany($entry->item)
                    ];
                },
            ];

        },
        'pages.json' => function() {

            return [
                'elementType' => Entry::class,
                'criteria' => ['section' => 'pages'],
                'transformer' => function(Entry $entry) {
                    $content = [];
                    /** @var \craft\elements\MatrixBlock $item */
                    foreach($entry->pageContent as $item) {
                        if (!$item->enabled) {
                            continue;
                        }
                        $content[] = [
                            'type' => $item->getType()->handle,
                            'content' => $item->text
                        ];
                    }

                    return [
                        'title' => $entry->title,
                        'pageContent' => $content
                    ];
                },
            ];

        },
    ]
];

