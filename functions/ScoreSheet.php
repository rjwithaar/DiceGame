<?php


namespace DiceGame;


class ScoreSheet extends Score
{
    public $scoreArea;

    public function __construct()
    {
        $this->scoreArea = new ScoreArea();
    }

    public function showScoreSheet()
    {
        $form = $this->loadPart('form');
        $area['div-row'] = '<div class="row m-0">';
        $area['yellow']  = $this->scoreArea->ScoreBlock('yellow', 4, 'me-2');
        $area['blue']    = $this->scoreArea->ScoreBlock('blue', 3, 'ms-2');
        $area['div-end'] = '</div>';
        $area['green']   = $this->scoreArea->ScoreLine('green');
        $area['orange']  = $this->scoreArea->ScoreLine('orange');
        $area['purple']  = $this->scoreArea->ScoreLine('purple');
        printf($form, implode(PHP_EOL, $area));
    }

}
