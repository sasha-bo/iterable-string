<?php

namespace SashaBo\IterableString;

class IterableString implements \Iterator
{
    protected int $length;
    protected int $position = 0;

    public function __construct(
        protected readonly string $source
    ) {
        $this->setLength();
    }

    protected function setLength(): void
    {
        $this->length = strlen($this->source);
    }

    public function rewind(): void
    {
        $this->position = 0;
    }

    public function current(int $length = 1): string
    {
        return substr($this->source, $this->position, $length);
    }

    public function next(int $steps = 1): void
    {
        $this->position += $steps;
    }

    public function previous(int $steps = 1): void
    {
        $this->position -= $steps;
    }

    public function key(): int
    {
        return $this->position;
    }

    public function valid(): bool
    {
        return $this->position >= 0 && $this->position < $this->length;
    }

    public function isLast(): bool
    {
        return $this->position >= $this->length - 1;
    }
}