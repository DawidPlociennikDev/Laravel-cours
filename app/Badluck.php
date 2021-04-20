<?php

namespace App;

class Badluck
{
    private $secret = "b/d";
    public function __construct(public int $var=1) {}

    public function brightMzimu() {
        return str_repeat("Mziuumu w światłochwale. Po prostu.\n\n", $this->var);
    }

    public function getSecret() {
        return $this->secret;
    }

    public function setSecret(string $s) { $this->secret = $s; }
}
