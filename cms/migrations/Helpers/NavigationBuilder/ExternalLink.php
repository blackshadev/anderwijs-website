<?php

namespace Migrations\Helpers\NavigationBuilder;

use Migrations\Helpers\EntryHelper;
use Migrations\Helpers\MatrixBlockInterface;

class ExternalLink extends NavigationItem
{
    private string $url;
    private string $title;

    public static function create(): self
    {
        return new self();
    }

    public function url(string $url): self
    {
        $this->url = $url;
        return $this;
    }

    public function title(string $title): ExternalLink
    {
        $this->title = $title;
        return $this;
    }

    public function asArray(): array
    {
        return [
            'type' => 'external',
            'navitemtitle' => $this->title,
            'linkURL' => $this->url
        ];
    }
}
