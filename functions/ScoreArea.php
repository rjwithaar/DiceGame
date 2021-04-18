<?php

namespace DiceGame;

class ScoreArea extends Score
{
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
     * @var array list of bonus blocks
     */
    private $bonus = [
        'green' => [
            '6' => 'B',
            '7' => 'F',
            '9' => 'P6'
        ],
        'orange' => [
            '5' => 'Y',
            '6' => '+1',
            '8' => 'F',
            '10' => 'P6'
        ],
        'purple' => [
            '4' => 'B',
            '5' => '+1',
            '6' => 'Y',
            '7' => 'F',
            '9' => 'G',
            '10' => 'O6',
            '11' => '+1'
        ]
    ];

    /**
     * ScoreArea constructor
     * Convert arrays to objects for easier access
     */
    public function __construct()
    {
        parent::__construct();
        $this->default = (object) $this->default;
        $this->bonus = (object) $this->bonus;
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
        $content = null;
        for ($i=1; $i<=$rows; $i++) {
            $content .= PHP_EOL . '<div class="d-flex">';
            for ($j = 1; $j <= 4; $j++) {
                $value = ($this->default->$color[$i.$j] == 'X') ? 'disabled' : (isset($_POST[$color.'-'.$i . $j]) ? 'checked' : null);
                $content .= PHP_EOL . sprintf($this->loadPart('check-block'), $color, $i . $j, $value, $this->default->$color[$i.$j], null);
            }
            $content .= PHP_EOL . '</div>';
        }
        return sprintf($area, $content, $class);
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
            $bonus = isset($this->bonus->$color[$i]) ? sprintf('bonus-data="%s"', $this->bonus->$color[$i]) : null;
            if ($color == 'green') {
                $scores[] = sprintf($this->loadPart('check-block'), $color, $i, isset($_POST[$color.'-'.$i]) ? 'checked' : null, $this->default->$color[$i], $bonus);
            } else {
                $scores[] = sprintf($this->loadPart('value-block'), $color, $i, $_POST[$color . '-' . $i], $this->default->$color[$i], $bonus);
            }
        }
        return sprintf($area, $color, implode(PHP_EOL, $scores));
    }
}