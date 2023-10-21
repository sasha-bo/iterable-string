<?php

use PHPUnit\Framework\TestCase;
use SashaBo\IterableString\IterableString;
use SashaBo\IterableString\MultibyteIterableString;

final class IterableStringTest extends TestCase
{
    private const STRING = 'visgaršīgākie āboli Rīgā';
    private const STRING_LENGTH = 30;
    private const MULTIBYTE_LENGTH = 24;

    public function testLengthIsCorrect(): void
    {
        $iterable = new IterableString(self::STRING);
        $this->assertEquals(self::STRING_LENGTH, $iterable->length());
    }

    public function testMultibyteLengthIsCorrect(): void
    {
        $iterable = new MultibyteIterableString(self::STRING);
        $this->assertEquals(self::MULTIBYTE_LENGTH, $iterable->length());
    }

    public function testEmptyString(): void
    {
        $iterable = new IterableString('');
        $this->assertEquals(0, $iterable->length());
        $this->assertCount(0, $iterable);
        $this->assertEquals(0, $iterable->key());
        $this->assertFalse($iterable->valid());
    }

    public function testIterateStringCorrectly(): void
    {
        $iterable = new IterableString(self::STRING);
        $chars = [];
        $positions = [];
        foreach ($iterable as $position => $char) {
            $chars[] = $char;
            $positions[] = $position;
        }
        $this->assertCount(self::STRING_LENGTH, $chars);
        $this->assertEquals(self::STRING, implode('', $chars));
        $this->assertEquals(self::STRING_LENGTH - 1, array_pop($positions));
    }

    public function testIterateMultibyteStringCorrectly(): void
    {
        $iterable = new MultibyteIterableString(self::STRING);
        $chars = [];
        $positions = [];
        foreach ($iterable as $position => $char) {
            $chars[] = $char;
            $positions[] = $position;
        }
        $this->assertCount(self::MULTIBYTE_LENGTH, $chars);
        $this->assertEquals(self::STRING, implode('', $chars));
        $this->assertEquals(self::MULTIBYTE_LENGTH - 1, array_pop($positions));
    }

    public function testMovePositionCorrectly(): void
    {
        $iterable = new IterableString(self::STRING);
        $iterable->next(3);
        $iterable->previous();
        $this->assertEquals(2, $iterable->key());
        $this->assertEquals(substr(self::STRING, 2, 1), $iterable->current());
        $iterable->rewind();
        $this->assertEquals(0, $iterable->key());
        $this->assertEquals(substr(self::STRING, 0, 1), $iterable->current());
    }

    public function testMoveMultibytePositionCorrectly(): void
    {
        $iterable = new MultibyteIterableString(self::STRING);
        $iterable->next(3);
        $iterable->previous();
        $this->assertEquals(2, $iterable->key());
        $this->assertEquals(mb_substr(self::STRING, 2, 1), $iterable->current());
        $iterable->rewind();
        $this->assertEquals(0, $iterable->key());
        $this->assertEquals(mb_substr(self::STRING, 0, 1), $iterable->current());
    }
}
