<?php

namespace Migrations\Helpers\NavigationBuilder;

use Migrations\Helpers\EntryHelper;
use Migrations\Helpers\MatrixBlockInterface;

class PageLink extends NavigationItem
{
    private string $pageSlug;

    public static function create(string $pageSlug): self
    {
        $link = new self();
        $link->pageSlug = $pageSlug;
        return $link;
    }

    public function pageSlug(string $pageSlug): PageLink
    {
        $this->pageSlug = $pageSlug;
        return $this;
    }

    protected function fields(): array
    {
        $page = EntryHelper::findBySlug('pages', $this->pageSlug);
        return [
            'page' => $page !== null ? [$page->id] : []
        ];
    }

    protected function type(): string
    {
        return 'page';
    }
}
