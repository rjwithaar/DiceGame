<?php

namespace DiceGame;

class Score
{
    public $post;

    public function __construct()
    {
        // Create dir constant
        if (!defined('PARTS_DIR')) {
            define('PARTS_DIR', dirname(__DIR__) . DS . 'scoresheet' . DS);
        }
        // Create post object array
        if (empty($this->post) && isset($_POST)) {
            $this->post = (object) $_POST;
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