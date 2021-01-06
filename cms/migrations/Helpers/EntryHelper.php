<?php


namespace Migrations\Helpers;


use craft\elements\Entry;

class EntryHelper
{
    public static function findBySlug(string $sectionHandle, string $slug): ?Entry
    {
        return Entry::find()->section($sectionHandle)->slug($slug)->one();
    }
}
