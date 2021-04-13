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
        $area['div-row'] = '<div class="row m-0"><div class="col col-1">&nbsp;</div>';
        $area['yellow']  = $this->scoreArea->ScoreBlock('yellow', 4, '');
        $area['divider'] = '<div class="col col-1">&nbsp;</div>';
        $area['blue']    = $this->scoreArea->ScoreBlock('blue', 3, '');
        $area['div-end'] = '</div>';
        $area['green']   = $this->scoreArea->ScoreLine('green');
        $area['orange']  = $this->scoreArea->ScoreLine('orange');
        $area['purple']  = $this->scoreArea->ScoreLine('purple');
        printf($form, implode(PHP_EOL, $area));
    }

}
