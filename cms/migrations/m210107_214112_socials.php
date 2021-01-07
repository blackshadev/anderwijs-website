<?php

namespace craft\contentmigrations;

use Craft;
use craft\db\Migration;
use Migrations\Helpers\EntryHelper;
use Webmozart\Assert\Assert;

/**
 * m210107_214112_socials migration.
 */
class m210107_214112_socials extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $socials = EntryHelper::single('socials');
        Assert::notNull($socials);

        EntryHelper::setFieldValues($socials, [
            'facebookUrl' => 'https://www.facebook.com/Anderwijs/',
            'instagramUrl' => 'https://www.instagram.com/anderwijsbijleskampen/',
            'twitterUrl' => 'https://www.twitter.com/Anderwijs/',
            'youtubeUrl' => 'https://www.youtube.com/channel/UC5q9ebHFOG01hyBzUQ-i37A',
        ]);

        EntryHelper::save($socials);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {}
}
