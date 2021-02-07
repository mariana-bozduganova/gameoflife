<?php

use GOL\LiveCell;
use \PHPUnit\Framework\TestCase;

class LiveCellTest extends TestCase
{
    /** @test */
    public function cell_suitable_living_conditions_are_satisfied_when_it_has_2_or_3_live_neighbors()
    {
        $cell = new LiveCell();

        $liveNeighborsCount = 2;

        $this->assertTrue($cell->hasSuitableLivingConditions($liveNeighborsCount));
    }

    /** @test */
    public function cell_suitable_living_conditions_are_not_satisfied_when_it_has_less_than_2_live_neighbors()
    {
        $cell = new LiveCell();

        $liveNeighborsCount = 1;

        $this->assertFalse($cell->hasSuitableLivingConditions($liveNeighborsCount));
    }

    /** @test */
    public function cell_suitable_living_conditions_are_not_satisfied_when_it_has_more_than_3_live_neighbors()
    {
        $cell = new LiveCell();

        $liveNeighborsCount = 4;

        $this->assertFalse($cell->hasSuitableLivingConditions($liveNeighborsCount));
    }
}