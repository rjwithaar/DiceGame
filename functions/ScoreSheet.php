<?php

namespace DiceGame;

class ScoreSheet extends Score
{
    public $scoreArea;
    public $scoreCalculation;

    /**
     * ScoreSheet constructor
     * Initialise ScoreArea and ScoreCalculation
     */
    public function __construct()
    {
        parent::__construct();
        $this->scoreArea = new ScoreArea();
        $this->scoreCalculation = new ScoreCalculation();
    }

    /**
     * Show full score sheet
     */
    public function showScoreSheet()
    {
        $form = $this->loadPart('form');
        $area['turn']    = $this->scoreArea->TurnArea();
        $area['div-row'] = '<div class="row mx-0 my-3"><div class="col col-1 p-0">&nbsp;</div>';
        $area['yellow']  = $this->scoreArea->ScoreBlock('yellow', 4, '');
        $area['divider'] = '<div class="col col-1 p-0">&nbsp;</div><div class="col col-1 p-0">&nbsp;</div>';
        $area['blue']    = $this->scoreArea->ScoreBlock('blue', 3, '');
        $area['div-end'] = '<div class="col col-1 p-0">&nbsp;</div></div>';
        $area['green']   = $this->scoreArea->ScoreLine('green');
        $area['orange']  = $this->scoreArea->ScoreLine('orange');
        $area['purple']  = $this->scoreArea->ScoreLine('purple');
        $area['score']   = $this->scoreCalculation->showScores();
        printf($form, implode(PHP_EOL, $area));
    }

}
