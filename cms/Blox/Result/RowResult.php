<?php


namespace Blox\Result;


class RowResult extends ArrayResult
{
    const DIRECTION_HORIZONTAL = 'horizontal';
    const DIRECTION_VERTICAL = 'vertical';

    private string $direction = self::DIRECTION_VERTICAL;

    /** @var ResultInterface[] */
    private array $items = [];

    public function __construct(array $data = [])
    {
        parent::__construct('row', $data);
    }

    public function addItem(ResultInterface $result)
    {
        $this->items[] = $result;
    }

    public function setDirection(string $direction): void
    {
        $this->direction = $direction;
    }

    public function jsonSerialize()
    {
        return array_merge(parent::jsonSerialize(), [ 'direction' => $this->direction, 'items' => $this->items ]);
    }
}
