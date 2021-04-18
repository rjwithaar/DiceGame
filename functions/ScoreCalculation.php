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
        $this->scores['blue'] = $this->countValues('blue');
        $this->scores['green'] = $this->countValues('green');
        $this->scores['orange'] = $this->sumValues('orange');
        $this->scores['purple'] = $this->sumValues('purple');
        $this->scores['bonus'] = $this->bonusScore();
        $this->scores['total'] = $this->totalScore();
    }

    /**
     * Show all scores
     * @return string
     */
    public function showScores()
    {
        $output = [];
        $output[] = '<div class="row mx-0 my-3 pt-3">';
        $output[] = sprintf($this->loadPart('score-block'), 'yellow', $this->scores['yellow']);
        $output[] = sprintf($this->loadPart('score-block'), 'blue', $this->scores['blue']);
        $output[] = sprintf($this->loadPart('score-block'), 'green', $this->scores['green']);
        $output[] = sprintf($this->loadPart('score-block'), 'orange', $this->scores['orange']);
        $output[] = sprintf($this->loadPart('score-block'), 'purple', $this->scores['purple']);
        $output[] = sprintf($this->loadPart('score-block'), 'red', $this->scores['bonus']);
        $output[] = sprintf($this->loadPart('score-block'), 'black', $this->scores['total']);
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
        $count = 0;
        foreach ($_POST as $key => $val) {
            if (strpos($key, $color) !== false) {
                $count++;
            }
        }
        return $this->points->$color[$count];
    }

    /**
     * Sum all values in an area
     * @param $color
     * @return int
     */
    public function sumValues($color)
    {
        $sum = 0;
        foreach ($_POST as $key => $val) {
            if (strpos($key, $color) !== false) {
                $sum = $sum + $val;
            }
        }
        return $sum;
    }

    /**
     * Calculate the score in the yellow area
     * @return int
     */
    public function crossValues()
    {
        $points = 0;
        if (isset($_POST['yellow-11']) && isset($_POST['yellow-21']) && isset($_POST['yellow-31'])) {
            $points = $points + 10;
        }
        if (isset($_POST['yellow-12']) && isset($_POST['yellow-22']) && isset($_POST['yellow-42'])) {
            $points = $points + 14;
        }
        if (isset($_POST['yellow-13']) && isset($_POST['yellow-33']) && isset($_POST['yellow-43'])) {
            $points = $points + 16;
        }
        if (isset($_POST['yellow-24']) && isset($_POST['yellow-34']) && isset($_POST['yellow-44'])) {
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
        if (isset($_POST['yellow-42']) && isset($_POST['yellow-43']) && isset($_POST['yellow-44'])) {
            $amount++;
        }
        // blue
        if (isset($_POST['blue-41']) && isset($_POST['blue-42']) && isset($_POST['blue-43']) && isset($_POST['blue-44'])) {
            $amount++;
        }
        // green
        if (isset($_POST['green-7'])) {
            $amount++;
        }
        // orange
        if (isset($_POST['orange-8'])) {
            $amount++;
        }
        // purple
        if (isset($_POST['purple-7'])) {
            $amount++;
        }
        return $amount * min($this->scores);
    }

    /**
     * Calculate the total score
     * @return int
     */
    public function totalScore()
    {
        return array_sum($this->scores);
    }
}