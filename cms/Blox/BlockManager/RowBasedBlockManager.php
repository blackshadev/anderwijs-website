<?php


namespace Blox\BlockManager;


use Blox\Result\ResultInterface;
use Blox\Result\RowResult;
use craft\elements\db\MatrixBlockQuery;
use craft\elements\MatrixBlock;

class RowBasedBlockManager extends BlockManager
{
    public function map(MatrixBlockQuery $items): array
    {
        /** @var RowResult[] $rows */
        $rows = [];
        /** @var ?RowResult $lastRow */
        $lastRow = null;

        foreach ($items as $item) {
            $block = $this->mapSingle($item);
            if ($block instanceof RowResult) {
                $lastRow = $rows[] = $block;
                continue;
            }

            if ($lastRow == null) {
                $rows[] = $lastRow = new RowResult();
            }

            $lastRow->addItem($block);
        }

        return $rows;
    }

}
