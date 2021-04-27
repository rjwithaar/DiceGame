<?php


namespace DiceGame;


class ScoreBonus extends Score
{
    /**
     * @var array list of bonus blocks
     */
    public $bonus = [
        'turn'   => [
            '1' => ['bonus', '&olarr;'],
            '2' => ['bonus', '+1'],
            '3' => ['bonus', '&olarr;'],
            '4' => ['bonus', 'X6'],
            '5' => ['bonus', '3P'],
            '6' => ['bonus', '2P']
        ],
        'yellow' => [
            '15' => ['blue-r', 'X'],
            '25' => ['orange-r', '4'],
            '35' => ['green-r', 'X'],
            '44' => ['bonus-c', '+1'],
            '45' => ['bonus-r', '&starf;']
        ],
        'blue' => [
            '15' => ['orange-r', '5'],
            '25' => ['yellow-r', 'X'],
            '31' => ['bonus', '&olarr;'],
            '32' => ['green', 'X'],
            '33' => ['purple', '6'],
            '34' => ['bonus', '+1'],
            '35' => ['bonus-r', '&starf;'],
        ],
        'green' => [
            '4' => ['bonus', '+1'],
            '6' => ['blue', 'X'],
            '7' => ['bonus', '&starf;'],
            '9' => ['purple', '6'],
            '10'=> ['bonus', '&olarr;']
        ],
        'orange' => [
            '3' => ['bonus', '&olarr;'],
            '4' => ['bonus', 'x2'],
            '5' => ['yellow', 'X'],
            '6' => ['bonus', '+1'],
            '7' => ['bonus', 'x2'],
            '8' => ['bonus', '&starf;'],
            '10'=> ['purple', '6']
        ],
        'purple' => [
            '3' => ['bonus', '&olarr;'],
            '4' => ['blue', 'X'],
            '5' => ['bonus', '+1'],
            '6' => ['yellow', 'X'],
            '7' => ['bonus', '&starf;'],
            '8' => ['bonus', '&olarr;'],
            '9' => ['green', 'X'],
            '10'=> ['orange', '6'],
            '11'=> ['bonus', '+1']
        ]
    ];

    /**
     * ScoreBonus constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->bonus = (object) $this->bonus;
    }

    /**
     * Create number box to count bonuses
     * @param $type
     * @param $symbol
     * @return string
     */
    public function BonusBlock($type, $symbol)
    {
        $box = $this->loadPart('bonus-block');
        $value = !empty($this->post->$type) ? $this->post->$type : 0;
        return sprintf($box, $type, $value, $symbol);
    }

    /**
     * Create bonus data
     * @param $color
     * @param $i
     * @return string|null
     */
    public function BonusData($color, $i)
    {
        return isset($this->bonus->$color[$i]) ? sprintf('bonus-color="%1$s" bonus-data="%2$s"', $this->bonus->$color[$i][0], $this->bonus->$color[$i][1]) : null;
    }

}