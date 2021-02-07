<?php

use GOL\Universe;
use GOL\Coordinates;
use PHPUnit\Framework\TestCase;

class UniverseTest extends TestCase
{
    /** @test */
    public function new_universe_is_empty_in_the_beginning()
    {
        $universe = Universe::empty();

        $this->assertTrue($universe->isEmpty());
    }

    /** @test */
    public function universe_is_no_longer_empty_after_live_cells_are_added_to_it()
    {
        $universe = Universe::empty();

        $universe->putLiveCellAtPosition(Coordinates::random());

        $this->assertFalse($universe->isEmpty());
    }

    /** @test */
    public function empty_universe_remains_empty_after_tick()
    {
        $universe = Universe::empty();

        $nextGeneration = $universe->tick();

        $this->assertTrue($nextGeneration->isEmpty());
    }

    /** @test */
    public function populated_universe_evolves_into_new_generation_after_tick()
    {
        // 1 - live; 0 - dead
        //
        // 1 0 0        0 0 0
        // 0 1 0        1 1 0
        // 1 0 0   -->  1 1 0
        // 1 0 0        0 0 0
        $universe = Universe::empty();

        $universe->putLiveCellAtPosition(new Coordinates(0, 0));
        $universe->putLiveCellAtPosition(new Coordinates(1, 1));
        $universe->putLiveCellAtPosition(new Coordinates(2, 0));
        $universe->putLiveCellAtPosition(new Coordinates(3, 0));

        $newGeneration = $universe->tick();

        $expectedNewGeneration = Universe::empty();
        $expectedNewGeneration->putLiveCellAtPosition(new Coordinates(1, 0));
        $expectedNewGeneration->putLiveCellAtPosition(new Coordinates(1, 1));
        $expectedNewGeneration->putLiveCellAtPosition(new Coordinates(2, 0));
        $expectedNewGeneration->putLiveCellAtPosition(new Coordinates(2, 1));

        $this->assertEquals($expectedNewGeneration, $newGeneration);
    }
}
