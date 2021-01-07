<?php

namespace Migrations\Helpers;

use craft\elements\Entry;

abstract class BaseEntry implements EntryInterface
{
    public function asEntry(): Entry {
        $entry = EntryHelper::create($this->section(), $this->fields());
        EntryHelper::save($entry);

        return $entry;
    }

    protected abstract function fields(): array;
    protected abstract function section(): string;
}
