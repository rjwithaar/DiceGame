<?php


namespace DiceGame;


class ScoreArea extends Score
{
    public function ScoreBlock($color, $rows, $class = null)
    {
        $area = $this->loadPart('area-block');
        $content = null;
        for ($i=0; $i<=$rows; $i++) {
            $content .= PHP_EOL . '<div class="row">';
            for ($j = 1; $j <= 5; $j++) {
                $content .= PHP_EOL . sprintf($this->loadPart('value-block'), $color, $i . $j, null);
            }
            $content .= PHP_EOL . '</div>';
        }
        $content .= '<div class="row">';
        for ($j = 0; $j < 5; $j++) {
            $content .= sprintf('<div class="col ratio ratio-1x1 m-1 rounded bg-%1$s text-center">&nbsp;</div>', $color, 'b' . $j, null);
        }
        $content .= '</div>';
        return sprintf($area, $content, $class);
    }

    public function ScoreLine($color)
    {
        $area = $this->loadPart('area-line');
        $scores = [];
        for ($i=1; $i<12; $i++) {
            $scores[] = sprintf($this->loadPart('value-block'), $color, $i, null);
        }
        return sprintf($area, $color, implode(PHP_EOL, $scores));
    }
}