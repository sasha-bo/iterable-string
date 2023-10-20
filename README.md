# iterable-string
PHP library which allow to iterate string characters in foreach without 
converting the string into array.

### IterableString

```php
foreach (new IterableString('lorem ipsum') as $position => $char) {
    echo $position.'['.$char.'] ';
}
```

or

```php
$iterableString = new IterableString('lorem ipsum');
while ($iterableString->valid()) {
    echo $iterableString->key().'['.$iterableString->current().'] ';
    $iterableString->next();
}
```

prints `0[l] 1[o] 2[r] 3[e] 4[m] 5[ ] 6[i] 7[p] 8[s] 9[u] 10[m]`

### MultibyteIterableString

Does the same, but uses mb_* functions, so works with UTF-8 correctly.

```php
foreach (new MultibyteIterableString('visgaršīgākie āboli Rīgā') as $position => $char) {
    echo $position.'['.$char.'] ';
}
```

prints `0[v] 1[i] 2[s] 3[g] 4[a] 5[r] 6[š] 7[ī] 8[g] 9[ā] 10[k] 11[i] 12[e] 13[ ] 14[ā] 15[b] 16[o] 17[l] 18[i] 19[ ] 20[R] 21[ī] 22[g] 23[ā]`

### Methods

`rewind(): void` - sets position to 0 (is called automatically when foreach starts)

`current(int $length = 1): string` - current character

`next(int $steps = 1): void` - increments the position

`previous(int $steps = 1): void` - decrements the position

`key(): int` - current position

`valid(): bool` - the current position is not less than 0 and not more than source string length

`check(int $position): bool` - the same for any position

`isLast(): bool` - true if current character is the last in source string

`length(): int` - the length of the source string (strlen or mb_strlen)

`set(int $position): void` - sets the position

`get(int $position, int $length = 1): string` - returns a character or few

### Installation

`composer require sashabo/iterable-string`