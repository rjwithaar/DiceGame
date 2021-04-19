<?php

namespace DiceGame;

class ScoreCalculation extends Score
{
    public $scores = [];
    public $points = [
        'blue' => [0, 1, 2, 4, 7, 11, 16, 22, 29, 37, 46, 56],
        'green' => [0, 1, 3, 6, 10, 15, 21, 28, 36, 45, 55, 66]
    ];

    /**
     * ScoreCalculation constructor
     * Convert array to object for easier access
     */
    public function __construct()
    {
        parent::__construct();
        $this->points = (object)$this->points;
        $this->calculateScores();
    }

    /**
     * Calculate all scores
     */
    public function calculateScores()
    {
        $this->scores['yellow'] = $this->crossValues();
        $this->scores['blue']   = $this->countValues('blue');
        $this->scores['green']  = $this->countValues('green');
        $this->scores['orange'] = $this->sumValues($this->post->orange);
        $this->scores['purple'] = $this->sumValues($this->post->purple);
        $this->scores['bonus']  = $this->bonusScore();
        $this->scores['total']  = $this->sumValues($this->scores);
    }

    /**
     * Show all scores
     * @return string
     */
    public function showScores()
    {
        $output = [];
        $output[] = '<div class="row mx-0 my-3 pt-3 calculation">';
        foreach ($this->scores as $key => $val) {
            $output[] = sprintf($this->loadPart('score-block'), $key, $val);
        }
        $output[] = '</div>';
        return implode(PHP_EOL, $output);
    }

    /**
     * Count all values in an area and return score
     * @param $color
     * @return int
     */
    public function countValues($color)
    {
        $count = count($this->post->$color);
        return $this->points->$color[$count];
    }

    /**
     * Sum all values in an area
     * @param $array
     * @return int
     */
    public function sumValues($array)
    {
        return !empty($array) ? array_sum($array) : 0;
    }

    /**
     * Calculate the score in the yellow area
     * @return int
     */
    public function crossValues()
    {
        $points = 0;
        if (empty($this->post->yellow)) {
            return 0;
        }
        if (!array_diff_key(array_flip([11,21,31]), $this->post->yellow)) {
            $points = $points + 10;
        }
        if (!array_diff_key(array_flip([12,22,42]), $this->post->yellow)) {
            $points = $points + 14;
        }
        if (!array_diff_key(array_flip([13,33,43]), $this->post->yellow)) {
            $points = $points + 16;
        }
        if (!array_diff_key(array_flip([24,34,44]), $this->post->yellow)) {
            $points = $points + 20;
        }
        return $points;
    }

    /**
     * Calculate the bonus score
     * @return int
     */
    public function bonusScore()
    {
        $amount = 0;
        // yellow
        if (!array_diff_key(array_flip([42,43,44]), $this->post->yellow)) {
            $amount++;
        }
        // blue
        if (!array_diff_key(array_flip([31,32,33,34]), $this->post->blue)) {
            $amount++;
        }
        // green
        if (!empty($this->post->green[7])) {
            $amount++;
        }
        // orange
        if (!empty($this->post->orange[8])) {
            $amount++;
        }
        // purple
        if (!empty($this->post->purple[7])) {
            $amount++;
        }
        return $amount * min($this->scores);
    }
}