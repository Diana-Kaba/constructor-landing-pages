<?php
abstract class Block
{
    protected $on;
    public function __construct($name)
    {
        $this->name = $name;
    }
    abstract public function draw();
}
