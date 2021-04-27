<?php

namespace DiceGame;

use DiceGame\ScoreBonus;

class ScoreArea extends Score
{
    public $ScoreBonus;

    /**
     * @var array list of default values
     */
    private $default = [
        'yellow' => [
            '11' => '3', '12' => '6', '13' => '5', '14' => 'X',
            '21' => '2', '22' => '1', '23' => 'X', '24' => '5',
            '31' => '1', '32' => 'X', '33' => '2', '34' => '4',
            '41' => 'X', '42' => '3', '43' => '4', '44' => '6'
        ],
        'blue' => [
            '11' => 'X', '12' => '2', '13' => '3', '14' => '4',
            '21' => '5', '22' => '6', '23' => '7', '24' => '8',
            '31' => '9', '32' => '10', '33' => '11', '34' => '12'
        ],
        'green' => [
            '1' => '>1', '2' => '>2', '3' => '>3', '4' => '>4', '5' => '>5', '6' => '>1',
            '7' => '>2', '8' => '>3', '9' => '>4', '10' => '>5', '11' => '>6'
        ]
    ];

    /**
     * ScoreArea constructor
     * Convert arrays to objects for easier access
     */
    public function __construct()
    {
        parent::__construct();
        $this->ScoreBonus = new ScoreBonus();
        $this->default = (object) $this->default;
    }

    /**
     * Function to create the score blocks area's
     * @param $color
     * @param $rows
     * @param null $class
     * @return string
     */
    public function ScoreBlock($color, $rows, $class = null)
    {
        $area = $this->loadPart('area-block');
        $content = [];
        for ($i=1; $i<=$rows; $i++) {
            $content[] = '<div class="d-flex">';
            for ($j = 1; $j <= 4; $j++) {
                $value = ($this->default->$color[$i.$j] == 'X') ? 'disabled' : (isset($this->post->$color[$i.$j]) ? 'checked' : null);
                $content[] = sprintf($this->loadPart('check-block'), $color, $i.$j, $value, $this->default->$color[$i.$j], $this->ScoreBonus->BonusData($color, $i.$j));
            }
            $content[] = sprintf($this->loadPart('empty-block'), $this->ScoreBonus->BonusData($color, $i.'5'));
            $content[] = '</div>';
        }
        return sprintf($area, implode(PHP_EOL, $content), $class);
    }

    /**
     * Function to create te score line area's
     * @param $color
     * @return string
     */
    public function ScoreLine($color)
    {
        $area = $this->loadPart('area-line');
        $scores = [];
        for ($i=1; $i<12; $i++) {
            $part = 'value-block';
            $value = $this->post->$color[$i];
            if ($color == 'green') {
                $part = 'check-block';
                $value = isset($this->post->$color[$i]) ? 'checked' : null;
            }
            $scores[] = sprintf($this->loadPart($part), $color, $i, $value, $this->default->$color[$i], $this->ScoreBonus->BonusData($color, $i));
        }
        return sprintf($area, $color, implode(PHP_EOL, $scores), '&#10140;');
    }

    /**
     * Create Turn area
     * @return string
     */
    public function TurnArea()
    {
        $area = [];
        $area[] = '<div class="row mx-0 my-3"><div class="col col-7 p-0">';
        $area[] = $this->loadPart('area-line');
        $area[] = '</div><div class="col col-1 p-0">&nbsp;</div><div class="col row p-0"><div class="d-flex my-3">';
        $area[] = $this->ScoreBonus->BonusBlock('retry', '&olarr;');
        $area[] = $this->ScoreBonus->BonusBlock('+1', '+1');
        $area[] = '</div></div></div>';

        $turns = [];
        for ($i=1; $i<=6; $i++) {
            $turns[] = sprintf($this->loadPart('check-block'), 'turn', $i, isset($this->post->turn[$i]) ? 'checked' : null, $i, $this->ScoreBonus->bonusData('turn', $i));
        }
        return sprintf(implode(PHP_EOL, $area), 'total', implode(PHP_EOL, $turns), '&#10140;');
    }

}