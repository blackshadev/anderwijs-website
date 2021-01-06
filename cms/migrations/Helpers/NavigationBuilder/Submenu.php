<?php

namespace Migrations\Helpers\NavigationBuilder;

use Migrations\Helpers\EntryHelper;

class Submenu extends NavigationItem
{
    private string $menuSlug;

    public static function create(): self
    {
        return new self();
    }

    public function menuSlug(string $slug): self
    {
        $this->menuSlug = $slug;
        return $this;
    }

    public function asArray(): array
    {
        $entry = EntryHelper::findBySlug('navigation', $this->menuSlug);

        return [
            'type' => 'submenu',
            'handle' => $entry !== null ? [$entry->id] : []
        ];
    }
}
