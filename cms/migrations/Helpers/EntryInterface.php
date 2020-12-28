<?php

namespace Migrations\Helpers;

use craft\elements\Entry;

interface EntryInterface
{
    public function section(): string;
    public function asEntry(): Entry;
}
