# Magma PHP Template Engine
A Template Engine that compiles to PHP.

## Requirements
PHP 7.2 or higher

## Syntax
The syntax is derived from php and modified as described bellow.
- Properties are access with a dot `.` instead of `->`.
- Strings are still joined with a dot `.`.
- Instead of `&&` and `||` you can use `and` and `or`.
- The foreach loop changes to: `for key, value in keyValue`.
- The for loop also allows an `else` keyword which triggers code if nothing gets looped.
- Instead of `<?= ?>` you can just use `| |`. Keep in mind that every 'Block' should only have one statement, keyword or expression. Example: `|if true||10 + 20||end|` this needs those three separated blocks to work.
- `else if` gets shortened to `elif`.
- You can use ranges `0..=10`.
- Variables don't need to be prefixed with a `$`.

*Note: Use enough whitespace for example this fails:
`|ctn.image.tag(page.lang)|`
but this works:
`|ctn.image.tag( page.lang )|`.
This behaviour should be fixed in the near future.*

Some methods can be accessed without brackets, like:
- `esc` to escape html symbols.
- `rep` to repeat some string `x` times.
- `inc` to include some new template file.
- `join` to replace php's implode.
- `dump` as a shortcut to `var_dump`.
- `replace` as a shortcut to `str_replace`.

## Examples

### Code
```
<p>|esc page.title|</p>
|a = 1|
|b = 2|
<p>Multiplies |a| with |b| equals |a * b|</p>
<p>Combine strings |'abc'. a. 'hey'|</p>

|for i in 0..=10|
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

|block 'my-block'| // the first occurence is used and the rest is ignored
  Thats in the block
|end|

|out 'my-block'|

|inc 'myotherfile', ['someVar' => ar]|
```

### HTML
- templs/test.html
- templs/main.html

### Execution
main.php

## TODO

Maybe make esc standard and create a method called raw.

### Methods
- .len()
- .substr()
- .esc()
- .rep( int )
