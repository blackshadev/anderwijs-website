<?php

namespace Migrations\Helpers\PageBuilder;

use Migrations\Helpers\EntryInterface;
use Migrations\Helpers\MatrixBlockInterface;
use craft\elements\Entry;

class Page implements EntryInterface
{
    private string $title;
    private ?string $slug = null;
    /** @var Row[] */
    private array $rows = [];

    public static function create(string $title): self
    {
        $page = new Page();
        $page->title($title);
        return $page;
    }

    public function title(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function slug(string $slug): self
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

    public function asEntry(): Entry
    {
        $entry = new Entry();
        $entry->title = $this->title;
        $entry->setFieldValue('pageContent', $this->rowsAsArray());

        $section = \Craft::$app->sections->getSectionByHandle('pages');
        $type = $section->getEntryTypes()[0];
        $entry->sectionId = $section->id;
        $entry->typeId = $type->id;

        return $entry;
    }

    public function section(): string
    {
        return 'page';
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
            $entry = Entry::find()->section('pages')->slug($slug)->one();
            if ($entry !== null) {
                \Craft::$app->getElements()->deleteElement($entry);
            }
        }
    }
}
