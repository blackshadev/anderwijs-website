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
            Page::create('Inschrijven scholieren', 'inschrijven-scholieren')
        );

        Page::save(
            Page::create('Inschrijven leiding', 'inschrijven-leiding')
        );

        Page::save(
            Page::create('Informatie voor nieuwe vrijwilligers', 'informatie-voor-nieuwe-vrijwilligers')
        );

        Page::save(
            Page::create('Ervaringen van leiding', 'ervaringen-van-leiding')
        );

        Page::save(
            Page::create('Ledenagenda', 'ledenagenda')
        );

        Page::save(
            Page::create('Bestuur en commissies', 'bestuur-en-commissies')
        );

        Page::save(
            Page::create('Startpagina voor leden', 'startpagina-voor-leden')
        );

        Page::save(
            Page::create('Contactgegevens', 'contact')
        );

        Page::save(
            Page::create('Doneren aan Anderwijs', 'doneren-aan-anderwijs')
        );

        Page::save(
            Page::create('Privacystatement', 'privacystatement')
        );

        Page::save(
            Page::create('Veelgestelde vragen', 'faq')
        );

        Page::save(
            Page::create('Preventie en integriteitsbeleid', 'preventie-en-integriteitsbeleid')
        );

        Page::save(
            Page::create('Thuispagina')
                ->slug('homepage')
                ->hideTitle()
                ->add(Row::vertical([
                    Image::create('hero.jpg'),
                    RichText::create('
                        <p>Welkom bij Anderwijs! De plek om te leren</p>
                    '),
                ]))
                ->add(Row::horizontal([
                    Image::create('placeholder.jpg'),
                    Image::create('placeholder.jpg'),
                    Image::create('placeholder.jpg'),
                    Image::create('placeholder.jpg'),
                    Image::create('placeholder.jpg'),
                    Image::create('placeholder.jpg'),
                    Image::create('placeholder.jpg'),
                    Image::create('placeholder.jpg'),
                ]))
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        Page::delete([
            'homepage', 'algemene-voorwaarden', 'kosten-en-korting', 'contact',
            'kampervaringen', 'het-hoe-en-wat-op-kamp', 'de-bijles-van-anderwijs',
            'inschrijven-scholieren', 'inschrijven-leiding', 'informatie-voor-nieuwe-vrijwilligers',
            'ervaringen-van-leiding', 'ledenagenda', 'bestuur-en-commissies', 'startpagina-voor-leden',
            'contact', 'doneren-aan-anderwijs', 'privacystatement', 'faq', 'preventie-en-integriteitsbeleid'
        ]);
    }
}
