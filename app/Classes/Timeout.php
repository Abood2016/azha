<?php

namespace App\Classes;

class Timeout
{
    public function __construct(callable $cb, int $time, $args)
    {
        $this->callback = $cb;
        $this->args = $args;
        $this->time = $time * 1000;
    }

    public function run()
    {
        usleep($this->time);
        ($this->callback)(...$this->args);
    }
}
