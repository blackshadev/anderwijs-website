<?php

namespace Migrations\Helpers\NavigationBuilder;

use craft\elements\Entry;

class Navigation
{
    private string $title;
    private ?string $slug = null;
    /** @var NavigationItem[] */
    private array $items = [];

    public function itemsAsArray(): array
    {
        $items = [];
        foreach ($this->items as $item) {
            $items[] = $item->asArray();
        }
        return $items;
    }

    public function slug(?string $slug): self
    {
        $this->slug = $slug;
        return $this;
    }

    public function title(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function item(NavigationItem $item): self
    {
        $this->items[] = $item;
        return $this;
    }

    public function asEntry(): Entry
    {
        $entry = new Entry();
        $entry->title = $this->title;
        $entry->setFieldValue('navigationitems', $this->itemsAsArray());

        $section = \Craft::$app->sections->getSectionByHandle('navigation');
        $type = $section->getEntryTypes()[0];
        $entry->sectionId = $section->id;
        $entry->typeId = $type->id;

        return $entry;
    }

    public static function create(): self
    {
        return new self();
    }

    public static function save(Navigation $navigation)
    {
        $saved = \Craft::$app->getElements()->saveElement($navigation->asEntry());
        if (!$saved) {
            throw new \Exception('Save failed on ' . $navigation->title);
        }
    }

    /**
     * @param string[] $slugs
     */
    public static function delete(array $slugs)
    {
        foreach ($slugs as $slug) {
            $entry = Entry::find()->section('navigation')->slug($slug)->one();
            if ($entry !== null) {
                \Craft::$app->getElements()->deleteElement($entry);
            }
        }
    }
}
