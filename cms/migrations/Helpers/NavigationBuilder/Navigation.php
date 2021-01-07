<?php

namespace Migrations\Helpers\NavigationBuilder;

use Migrations\Helpers\BaseEntry;
use Migrations\Helpers\EntryHelper;

class Navigation extends BaseEntry
{
    const SECTION = 'navigation';

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
            $entry = EntryHelper::findBySlug(self::SECTION, $slug);
            if ($entry !== null) {
                \Craft::$app->getElements()->deleteElement($entry);
            }
        }
    }

    protected function fields(): array
    {
        return [
            'title' => $this->title,
            'slug' => $this->slug,
            'navigationitems' => $this->itemsAsArray(),
        ];
    }

    protected function section(): string
    {
        return self::SECTION;
    }
}
