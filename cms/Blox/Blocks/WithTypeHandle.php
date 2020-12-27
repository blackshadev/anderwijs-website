<?php


namespace Blox\Blocks;


use craft\elements\MatrixBlock;

trait WithTypeHandle
{
    private $handle;
    public static function byTypeHandle(string $handle): self
    {
        $item = new static();
        $item->handle = $handle;
        return $item;
    }

    protected function matchTypeHandle(MatrixBlock $item): bool
    {
        return $item->getType()->handle === $this->handle;
    }

}
