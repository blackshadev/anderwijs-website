<?php

namespace Blox\Result;

class ArrayResult implements ResultInterface
{
    private string $type;
    private array $data;
    public static function fromArray(string $type, array $data)
    {
        $result = new ArrayResult();
        $result->type = $type;
        $result->data = $data;
        return $result;
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
