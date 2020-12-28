<?php

namespace Migrations\Helpers\PageBuilder;

use Blox\Result\RowResult;
use Migrations\Helpers\MatrixBlock;
use Migrations\Helpers\MatrixBlockInterface;

class Row extends MatrixBlock
{
    private string $direction = RowResult::DIRECTION_VERTICAL;
    private ?string $title = null;
    private array $blocks;

    /** @param MatrixBlock[] $blocks */
    public static function horizontal(array $blocks)
    {
        $row = new self();
        $row->direction = RowResult::DIRECTION_HORIZONTAL;
        $row->blocks = $blocks;
        return $row;
    }

    /** @param MatrixBlock[] $blocks */
    public static function vertical(array $blocks)
    {
        $row = new self();
        $row->direction = RowResult::DIRECTION_VERTICAL;
        $row->blocks = $blocks;
        return $row;
    }

    public function setDirection(string $direction): self
    {
        $this->direction = $direction;
        return $this;
    }

    public function setTitle(?string $title): Row
    {
        $this->title = $title;
        return $this;
    }

    protected function fields(): array
    {
        return [
            'rowDirection' => $this->direction,
            'rowTitle' => $this->title,
        ];
    }

    protected function type(): string
    {
        return 'row';
    }

    /** @return MatrixBlockInterface[] */
    public function blocks(): array
    {
        return $this->blocks;
    }
}
