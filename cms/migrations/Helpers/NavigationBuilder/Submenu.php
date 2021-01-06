<?php

namespace Migrations\Helpers\NavigationBuilder;

use Migrations\Helpers\EntryHelper;

class Submenu extends NavigationItem
{
    private string $menuSlug;

    public static function create(string $slug): self
    {
        $submenu = new self();
        $submenu->menuSlug = $slug;
        return $submenu;
    }

    protected function fields(): array
    {
        $entry = EntryHelper::findBySlug('navigation', $this->menuSlug);

        return [
            'submenu' => $entry !== null ? [$entry->id] : []
        ];
    }

    protected function type(): string
    {
        return 'submenu';
    }
}
