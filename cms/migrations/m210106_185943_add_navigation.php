<?php

namespace craft\contentmigrations;

use Craft;
use craft\db\Migration;
use Migrations\Helpers\NavigationBuilder\ExternalLink;
use Migrations\Helpers\NavigationBuilder\Navigation;
use Migrations\Helpers\NavigationBuilder\PageLink;
use Migrations\Helpers\NavigationBuilder\Submenu;

/**
 * m210106_185943_add_navigation migration.
 */
class m210106_185943_add_navigation extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        Navigation::save(
            Navigation::create()
                ->slug('bijles')
                ->title('Bijles')
                ->item(PageLink::create('test-page'))
                ->item(
                    ExternalLink::create()
                        ->title('Anderwijs')
                        ->url('https://anderwijs.nl')
                )
        );

        Navigation::save(
            Navigation::create()
                ->slug('vrijwilligers')
                ->title('Vrijwilligers')
                ->item(PageLink::create('test-page'))
                ->item(
                    ExternalLink::create()
                        ->title('Aas')
                        ->url('https://aas2.anderwijs.nl')
                )
        );

        Navigation::save(
            Navigation::create()
                ->title('Hoofdmenu')
                ->slug('main')
                ->item(Submenu::create()->menuSlug('bijles'))
                ->item(Submenu::create()->menuSlug('vrijwilligers'))
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        Navigation::delete(['main', 'vrijwilligers', 'bijles']);
    }
}
