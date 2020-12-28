<?php

namespace Migrations\Helpers\PageBuilder;

use Migrations\Helpers\EntryInterface;
use Migrations\Helpers\MatrixBlockInterface;
use craft\elements\Entry;

class Page implements EntryInterface
{
    private string $title;
    /** @var Row[] */
    private array $rows = [];

    public static function create($title): self
    {
        $page = new Page();
        $page->setTitle($title);
        return $page;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
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

    public static function delete(string $slug)
    {
        $entry = Entry::find()->section('pages')->slug($slug)->one();
        \Craft::$app->getElements()->deleteElement($entry);
    }
}
