<?php

namespace Migrations\Helpers;

use craft\elements\Entry;

interface EntryInterface
{
    public function asEntry(): Entry;
}
