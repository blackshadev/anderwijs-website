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
        // Place migration code here...
        $page = Page::create('Test pagina')
            ->slug('test-pagina')
            ->add(Row::vertical([
                RichText::create('test'),
                Image::create()
                    ->setTitle('Groen')
                    ->setImage('tenor.gif')
                    ->setVolume('local')
            ]));

        Page::save($page);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        Page::delete(['test-pagina']);
    }
}
