<?php

namespace Blox\Result;

class ArrayResult implements ResultInterface
{
    private string $type;
    private array $data;
    public static function fromArray(string $type, array $data)
    {
        return new ArrayResult($type, $data);
    }

    public function __construct(string $type, array $data)
    {
        $this->type = $type;
        $this->data = $data;
    }

    public function type()
    {
        return $this->type;
    }

    public function data()
    {
        return $this->data;
    }

    public function jsonSerialize()
    {
        return array_merge(['type' => $this->type()], $this->data());
    }
}
