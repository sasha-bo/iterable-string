<?php

namespace SashaBo\IterableString;

class MultibyteIterableString extends IterableString
{
    protected function setLength(): void
    {
        $this->length = mb_strlen($this->source);
    }

    public function get(int $position, int $length = 1): string
    {
        return mb_substr($this->source, $position, $length);
    }
}
