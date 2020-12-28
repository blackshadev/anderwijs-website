<?php

namespace Migrations\Helpers;

abstract class MatrixBlock implements MatrixBlockInterface
{

    abstract protected function fields(): array;
    abstract protected function type(): string;

    public function beforeLoad(): void
    {}

    public function asArray(): array
    {
        return [
            'type' => $this->type(),
            'enabled' => true,
            'fields' => $this->fields(),
        ];
    }

}
