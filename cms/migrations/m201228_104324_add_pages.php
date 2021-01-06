<?php

namespace craft\contentmigrations;

use Craft;
use craft\db\Migration;
use craft\elements\Entry;
use Migrations\Helpers\PageBuilder\Image;
use Migrations\Helpers\PageBuilder\Page;
use Migrations\Helpers\PageBuilder\RichText;
use Migrations\Helpers\PageBuilder\Row;

/**
 * m201228_104324_add_pages migration.
 */
class m201228_104324_add_pages extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        Page::save(
            Page::create('De bijles van anderwijs', 'de-bijles-van-anderwijs')
        );

        Page::save(
            Page::create('Het hoe en wat op kamp', 'het-hoe-en-wat-op-kamp')
        );

        Page::save(
            Page::create('Kampervaringen', 'kampervaringen')
        );

        Page::save(
            Page::create('Kosten en korting', 'kosten-en-korting')
        );

        Page::save(
            Page::create('Algemene voorwaarde', 'algemene-voorwaarden')
        );

        Page::save(
            Page::create('Test pagina')
                ->slug('test-pagina')
                ->add(Row::vertical([
                    RichText::create('test'),
                    Image::create()
                        ->setTitle('Groen')
                        ->setImage('tenor.gif')
                        ->setVolume('local')
                ]))
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        Page::delete([
            'test-pagina', 'algemene-voorwaarden', 'kosten-en-korting', 'contact',
            'kampervaringen', 'het-hoe-en-wat-op-kamp', 'de-bijles-van-anderwijs'
        ]);
    }
}
