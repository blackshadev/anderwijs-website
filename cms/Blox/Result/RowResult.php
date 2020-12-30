<?php


namespace Blox\Result;


class RowResult extends ArrayResult
{
    const DIRECTION_HORIZONTAL = 'horizontal';
    const DIRECTION_VERTICAL = 'vertical';

    private string $direction = self::DIRECTION_VERTICAL;

    private ?string $title = null;

    /** @var ResultInterface[] */
    private array $items = [];

    public static function create(string $direction, ?string $title, array $data)
    {
        $row = new self($data);
        $row->setTitle($title);
        $row->setDirection($direction);
        return $row;
    }

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

    public function setTitle(?string $title): RowResult
    {
        $this->title = $title;
        return $this;
    }

    public function jsonSerialize()
    {
        return array_merge(parent::jsonSerialize(), [
            'title' => $this->title,
            'direction' => $this->direction,
            'items' => $this->items
        ]);
    }

}
