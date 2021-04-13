<?php


namespace DiceGame;


class ScoreArea extends Score
{
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

    public function __construct()
    {
        $this->default = (object) $this->default;
    }

    public function ScoreBlock($color, $rows, $class = null)
    {
        $area = $this->loadPart('area-block');
        $content = null;
        for ($i=1; $i<=$rows; $i++) {
            $content .= PHP_EOL . '<div class="d-flex">';
            for ($j = 1; $j <= 4; $j++) {
                $content .= PHP_EOL . sprintf($this->loadPart('value-block'), $color, $i . $j, $_POST[$color.'-'.$i . $j], $this->default->$color[$i.$j]);
            }
            $content .= PHP_EOL . '</div>';
        }
        return sprintf($area, $content, $class);
    }

    public function ScoreLine($color)
    {
        $area = $this->loadPart('area-line');
        $scores = [];
        for ($i=1; $i<12; $i++) {
            $scores[] = sprintf($this->loadPart('value-block'), $color, $i, $_POST[$color.'-'.$i], $this->default->$color[$i]);
        }
        return sprintf($area, $color, implode(PHP_EOL, $scores));
    }
}