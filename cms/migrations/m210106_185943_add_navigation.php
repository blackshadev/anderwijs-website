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
                ->item(PageLink::create('de-bijles-van-anderwijs'))
                ->item(PageLink::create('het-hoe-en-wat-op-kamp'))
                ->item(PageLink::create('kampervaringen'))
                ->item(PageLink::create('kampagenda'))
                ->item(PageLink::create('kosten-en-korting'))
                ->item(PageLink::create('algemene-voorwaarden'))
        );

        Navigation::save(
            Navigation::create()
                ->slug('vrijwilligers')
                ->title('Vrijwilligers')
                ->item(PageLink::create('test-pagina'))
                ->item(
                    ExternalLink::create()
                        ->title('Aas')
                        ->url('https://aas2.anderwijs.nl')
                )
        );

        Navigation::save(
            Navigation::create()
                ->slug('contact')
                ->title('Contact')
                ->item(PageLink::create('test-pagina'))
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
                ->item(Submenu::create('bijles'))
                ->item(Submenu::create('vrijwilligers'))
                ->item(Submenu::create('contact'))
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
