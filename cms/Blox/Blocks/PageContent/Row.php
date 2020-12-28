<?php

namespace Blox\Blocks\PageContent;

use Blox\Blocks\Block;
use Blox\Result\ResultInterface;
use Blox\Result\RowResult;
use craft\elements\MatrixBlock;

class Row extends Block
{
    public static function translateDirection(string $rowDirection): string
    {
        switch ($rowDirection) {
            case 'horizontal': return RowResult::DIRECTION_HORIZONTAL;
            case 'vertical': return RowResult::DIRECTION_VERTICAL;
        }

        throw new \UnexpectedValueException('Unexpected row direction, got ' . $rowDirection);
    }

    public function map(MatrixBlock $block): ResultInterface
    {
        $direction = self::translateDirection($block->rowDirection);

        return new RowResult([
            'direction' => $direction,
            'title' => $block->rowTitle
        ]);
    }
}
