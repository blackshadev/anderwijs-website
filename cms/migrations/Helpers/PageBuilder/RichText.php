<?php

namespace Migrations\Helpers\PageBuilder;

use Migrations\Helpers\MatrixBlock;

class RichText extends MatrixBlock
{
    private string $body;

    public static function create(string $body) {
        $text = new self();
        $text->body = $body;
        return $text;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;
        return $this;
    }

    protected function fields(): array
    {
        return [
            'body' => $this->body,
        ];
    }

    protected function type(): string
    {
        return 'richtext';
    }
}
