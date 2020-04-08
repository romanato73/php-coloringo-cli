# php-coloringo-cli
Colors and styles for PHP CLI output.

## Installation

```
composer require romanato/php-coloringo-cli
```

## Usage

```php
// Create new instance
$console = new Romanato\ColoringoCLI\Coloringo;

// Set output
print $console->out('100% Awesomeness');

// Set inline output (without new line)
print $console->inline('100% Awesomeness');

// Set color
print $console->out('Text of this message is red.', 'red');
```

## Advanced usage

```php
// Set other attributes
print $console->out('A lot of attributes!', [
    'color' => 'magenta',
    'background' => 'blue',
    'style' => 'underline'
]);

// Merge more outputs inside one print
print(
    $console->out('This is first line', 'red')
    .$console->inline('This is second line.', [
        'color' => 'yellow',
        'style' => 'bold'
    ])
    .$console->out(' Still second line but gonna make another line.', 'green')
);
```

## Attributes

Available attributes are: `color`, `background`, `style`

**Available colors (and backgrounds):**
* default
* white
* black
* red
* green
* yellow
* blue
* magenta
* cyan
* light_grey
* dark_grey
* light_red
* light_green
* light_yellow
* light_blue
* light_magenta
* light_cyan

**Available styles:**
* bold
* dim
* underline
* blink
* reverse
* hidden

## Methods

You can use also some methods that are made just for you.

#### newLine()

This method creates a new line.

```php
print $console->newLine();
```

#### isSupported()

Checks if the php script is running via CLI.

```php
print $console->isSupported();
```

## Properties

Properties of the class are basically the configuration of all colors and styles.
You can see all available attributes and their values.

#### color

You can see all supported (foreground) colors.

```php
print $console->color;
```

#### background

You can see all supported (background) colors.

```php
print $console->background;
```

#### style

You can see all supported styles.

```php
print $console->style;
```

## Customization

You can set your own colors and styles very easily by editing: `Coloringo.php` class.

```php
class Coloringo
{
    public $color = [
        '...' => '..',
        'customColor' => 'code'
    ];

    public $background = [
        '...' => '..',
        'customBackground' => 'code'
    ];

    public $styles = [
        '...' => '..',
        'customStyle' => 'code'
    ];
}
```