# Magma PHP Template Engine
A new PHP Template Engine. Compiles to PHP.
At the moment is a combination of the PHP syntax and Magma syntax.
More features will be added.

## Requirements
PHP 7.2 or bigger

## Examples

### Code
```
<p>|esc page.title|</p>
|a = 1|
|b = 2|
<p>Multiplies |a| with |b| equals |a * b|</p>
<p>Combine strings |'abc'. a. 'hey'|</p>

|for i 0..=10|
  Counting up |i|/10
|end|

|if a == 1 and b == 1|
|elif b == 2|
|else|
|end|

<p>Inline |a == 1 ? '1' :|</p>
<p>C |c ?? 'nope'|</p>

|ar = ['a', 'b', 'c', 'd']|
|for k, a in ar|
  |k| => |a|
|else|
  No Items
|end|

|rep 10, '.'|
```

### HTML
templs/test.html
templs/main.html

### Execution
main.php

## Future

### Methods
- .len()
- .substr()
- .esc()
- .rep( int )
