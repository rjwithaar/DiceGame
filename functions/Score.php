<?php

namespace DiceGame;

class Score
{
    public function __construct()
    {
        if (!defined('PARTS_DIR')) {
            define('PARTS_DIR', dirname(__DIR__) . DS . 'scoresheet' . DS);
        }
    }

    public function loadPart($name)
    {
        $part = file_get_contents(PARTS_DIR . $name . '.php');
        if (!empty($part)) {
            return $part;
        }
        return false;
    }
}

new Score();