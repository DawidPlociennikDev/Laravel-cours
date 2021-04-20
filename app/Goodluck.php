<?php

namespace App;

class Goodluck
{
    public function __construct(public int $var=1) {}
    public function darkMzimu() {
        return str_repeat("Mziuuumuuuuuuuu Mziiiiiii\n\n", $this->var);
    }
}
