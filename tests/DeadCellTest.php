<?php

use GOL\DeadCell;
use \PHPUnit\Framework\TestCase;

class DeadCellTest extends TestCase
{
    /** @test */
    public function cell_suitable_living_conditions_are_satisfied_when_it_has_exactly_3_live_neighbors()
    {
        $cell = new DeadCell();

        $liveNeighborsCount = 3;

        $this->assertTrue($cell->hasSuitableLivingConditions($liveNeighborsCount));
    }

    /** @test */
    public function cell_suitable_living_conditions_are_not_satisfied_when_its_live_neighbors_are_not_3()
    {
        $cell = new DeadCell();

        $liveNeighborsCount = 2;

        $this->assertFalse($cell->hasSuitableLivingConditions($liveNeighborsCount));
    }
}