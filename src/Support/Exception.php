<?php


namespace Romanato\ColoringoCLI\Support;


use Romanato\ColoringoCLI\Coloringo;
use Throwable;

class Exception extends \Exception
{
    protected $prefix = "ColoringoCLI: ";

    protected $console;

    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);

        $this->console = new Coloringo();
    }

    public function colorNotFound()
    {
        die($this->console->out($this->prefix . $this->getMessage(), 'red'));
    }

    public function attributeNotFound()
    {
        die($this->console->out($this->prefix . $this->getMessage(), 'red'));
    }

    public function attributesValueNotFound()
    {
        die($this->console->out($this->prefix . $this->getMessage(), 'red'));
    }
}