<?php

use craft\elements\Entry;

return [
    'endpoints' => [
        'navigation.json' => function() {

            return [
                'elementType' => Entry::class,
                'criteria' => ['section' => 'navigation', 'slug' => 'main'],
                'transformer' => function(Entry $entry) {

                    /** @var \Blox\BlockManager\BlockManagerInterface $blockMapper */
                    $blockMapper = Craft::$container->get('navigation');

                    return [
                        'title' => $entry->title,
                        'item' => $blockMapper->map($entry->navigationitems)
                    ];
                },
            ];

        },
        'pages.json' => function() {

            return [
                'elementType' => Entry::class,
                'criteria' => ['section' => 'pages'],
                'paginate' => false,
                'transformer' => function(Entry $entry) {
                    return [
                        'title' => $entry->title,
                        'slug' => $entry->slug
                    ];
                },
            ];
        },
        'pages/<slug>.json' => function($slug) {

            return [
                'elementType' => Entry::class,
                'criteria' => ['section' => 'pages', 'slug' => $slug ],
                'one' => true,
                'transformer' => function(Entry $entry) {
                    /** @var \Blox\BlockManager\BlockManagerInterface $blockMapper */
                    $blockMapper = Craft::$container->get('pageContent');

                    return [
                        'title' => $entry->title,
                        'slug' => $entry->slug,
                        'content' => $blockMapper->map($entry->pageContent)
                    ];
                }
            ];
        }
    ]
];
