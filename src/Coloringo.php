<?php


namespace Romanato\ColoringoCLI;


use Romanato\ColoringoCLI\Support\Exception;

class Coloringo
{
    private $isSupported;

    public $color = [
        'default' => '39',
        'black' => '30',
        'red' => '31',
        'green' => '32',
        'yellow' => '33',
        'blue' => '34',
        'magenta' => '35',
        'cyan' => '36',
        'light_grey' => '37',
        'dark_grey' => '90',
        'light_red' => '91',
        'light_green' => '92',
        'light_yellow' => '93',
        'light_blue' => '94',
        'light_magenta' => '95',
        'light_cyan' => '96',
        'white' => '97',
    ];

    public $background = [
        'default' => '49',
        'black' => '40',
        'red' => '41',
        'green' => '42',
        'yellow' => '43',
        'blue' => '44',
        'magenta' => '45',
        'cyan' => '46',
        'light_grey' => '47',
        'dark_grey' => '101',
        'light_red' => '101',
        'light_green' => '102',
        'light_yellow' => '103',
        'light_blue' => '104',
        'light_magenta' => '105',
        'light_cyan' => '106',
        'white' => '107',
    ];

    public $style = [
        'bold' => '1',
        'dim' => '2',
        'underline' => '4',
        'blink' => '5',
        'reverse' => '7',
        'hidden' => '8',
    ];

    public $attributes = [
        'color', 'background', 'style'
    ];

    /**
     * Initialize isSupported variable.
     */
    public function __construct()
    {
        $this->isSupported = $this->isSupported();
    }

    /**
     * Print out string with a new line at the end.
     *
     * @param string $text
     * @param string|array $attributes
     * @return string
     */
    public function out($text, $attributes = 'default')
    {
        if (!$this->isSupported) {
            return $text . "\n";
        }

        return "{$this->setStyle($attributes)}{$text}{$this->clearStyles()}\n";

    }

    /**
     * Print out string without a new line.
     *
     * @param string $text
     * @param string $attributes
     * @return string
     */
    public function inline($text, $attributes = 'default')
    {
        if (!$this->isSupported) {
            return $text;
        }

        return "{$this->setStyle($attributes)}{$text}{$this->clearStyles()}";
    }

    /**
     * Print a new line.
     *
     * @return string
     */
    public function newLine()
    {
        return "\n";
    }

    /**
     * Sets the style for the string.
     *
     * @param string|array $attributes
     * @return string
     */
    private function setStyle($attributes = [])
    {
        // If string set only color
        if (is_string($attributes)) {
            // Check if color is in list of colors
            try {
                foreach ($this->color as $color => $code) {
                    if ($attributes == $color) {
                        return "\e[{$code}m";
                    }
                }

                throw new Exception("Color '{$attributes}' does not exist.");
            } catch (Exception $exception) {
                die($exception->colorNotFound());
            }
        }

        // Set style if array passed
        $style = '';

        // Check if property exists
        try {
            foreach (array_keys($attributes) as $attribute) {
                if (!property_exists(get_class($this), $attribute)) {
                    throw new Exception("Unknown attribute '{$attribute}'.");
                }
            }
        } catch (Exception $exception) {
            die($exception->attributeNotFound());
        }

        // Check if value exists in that property
        try {
            foreach ($attributes as $attribute => $value) {
                if (!in_array($value, array_keys($this->$attribute))) {
                    throw new Exception("Unknown value '{$value}' of an attribute {$attribute}.");
                }
                // Set style
                $style .= ';' . $this->$attribute[$value];
            }
        } catch (Exception $exception) {
            die($exception->attributesValueNotFound());
        }

        // Return style if all tests passed
        return "\e[{$style}m";
    }

    /**
     * Clear the default styles.
     *
     * @return string
     */
    private function clearStyles()
    {
        return "\e[0m";
    }

    /**
     * Check if script running from CLI.
     *
     * @return bool
     */
    public function isSupported()
    {
        return php_sapi_name() == 'cli' ? true : false;
    }

    /**
     * TODO: Remove print ??
     */
}