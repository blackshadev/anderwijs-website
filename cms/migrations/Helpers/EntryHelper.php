<?php


namespace Migrations\Helpers;


use craft\base\Element;
use craft\elements\Entry;
use Webmozart\Assert\Assert;

class EntryHelper
{
    public static function findBySlug(string $sectionHandle, string $slug): ?Entry
    {
        return Entry::find()->section($sectionHandle)->slug($slug)->one();
    }

    public static function create(string $sectionHandle, array $data): Entry
    {
        $entry = new Entry();

        $section = \Craft::$app->sections->getSectionByHandle($sectionHandle);
        Assert::notNull($section);

        $type = $section->getEntryTypes()[0];
        Assert::notNull($type);

        $entry->sectionId = $section->id;
        $entry->typeId = $type->id;

        foreach($data as $field => $value) {
            self::setFieldValue($entry, $field, $value);
        }

        return $entry;
    }

    public static function save(Entry $entry): bool
    {
        return \Craft::$app->elements->saveElement($entry);
    }

    public static function setFieldValues(Entry $entry, array $data)
    {
        foreach($data as $field => $value) {
            self::setFieldValue($entry, $field, $value);
        }
    }

    public static function setFieldValue(Entry $entry, string $field, $value)
    {
        $value = self::normalizeValue($value);

        $customFields = $entry->getBehavior('customFields');
        Assert::notNull($customFields);

        if ($customFields->hasProperty($field)) {
            $entry->setFieldValue($field, $value);
        } else {
            $entry->$field = $value;
        }
    }

    private static function normalizeValue($value)
    {
        if ($value instanceof Element) {
            return [$value->id];
        }
        if(is_array($value) && count(array_filter($value, fn ($item) => !$item instanceof Element)) === 0) {
            return array_map(fn ($item) => $item->id, $value);
        }

        return $value;
    }

    public static function single(string $sectionHandle): ?Entry
    {
        return Entry::find()->section($sectionHandle)->one();
    }
}
