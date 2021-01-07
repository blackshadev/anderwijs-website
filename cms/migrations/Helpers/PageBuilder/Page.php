<?php

namespace Migrations\Helpers\PageBuilder;

use Migrations\Helpers\BaseEntry;
use craft\elements\Entry;

class Page extends BaseEntry
{
    const SECTION = 'pages';

    private string $title;
    private ?string $slug = null;
    private bool $showTitle = true;
    /** @var Row[] */
    private array $rows = [];

    public static function create(string $title, string $slug = null): self
    {
        $page = new Page();
        $page->title($title);
        $page->slug($slug);
        return $page;
    }

    public function hideTitle(): self
    {
        $this->showTitle = false;
        return $this;
    }

    public function title(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function slug(?string $slug): self
    {
        $this->slug = $slug;
        return $this;
    }

    public function add(Row $row): self
    {
        $this->rows[] = $row;
        return $this;
    }

    protected function rowsAsArray(): array
    {
        $blocks = [];
        foreach ($this->rows as $row) {
            $row->beforeLoad();
            $blocks[] = $row->asArray();

            foreach ($row->blocks() as $block) {
                $block->beforeLoad();
                $blocks[] = $block->asArray();
            }
        }

        return $blocks;
    }

    protected function section(): string
    {
        return self::SECTION;
    }

    protected function fields(): array
    {
        return [
            'title' => $this->title,
            'pageContent' => $this->rowsAsArray(),
            'showTitle' => $this->showTitle,
        ];
    }

    public static function save(Page $page)
    {
        \Craft::$app->getElements()->saveElement($page->asEntry());
    }

    /**
     * @param string[] $slugs
     */
    public static function delete(array $slugs)
    {
        foreach ($slugs as $slug) {
            $entry = Entry::find()->section(self::SECTION)->slug($slug)->one();
            if ($entry !== null) {
                \Craft::$app->getElements()->deleteElement($entry);
            }
        }
    }
}
