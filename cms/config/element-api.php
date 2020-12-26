<?php

use craft\elements\Entry;
use craft\helpers\UrlHelper;

return [
    'endpoints' => [
        'navigation.json' => function() {

            return [
                'elementType' => Entry::class,
                'criteria' => ['section' => 'pages'],
                'transformer' => function(Entry $entry) {
                    return [
                        'parent' => null,
                        'title' => $entry->title,
                        'slug' => $entry->slug,

                    ];
                },
            ];

        },
        'pages.json' => function() {

            return [
                'elementType' => Entry::class,
                'criteria' => ['section' => 'pages'],
                'transformer' => function(Entry $entry) {
                    return [
                        'title' => $entry->title,
                        'url' => $entry->url,
                        'content' => []
                    ];
                },
            ];

        },
    ]
];

