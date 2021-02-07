<?php

namespace GOL;

class CellNeighborhood
{
    /**
     * @var Cell
     */
    private $cell;
    /**
     * @var array
     */
    private $neighbors;
    /**
     * @var int
     */
    private $liveNeighborsCount;

    /**
     * CellNeighborhood constructor.
     * @param Cell $cell
     * @param array $neighbors
     */
    public function __construct(Cell $cell, array $neighbors)
    {
        $this->cell = $cell;
        $this->neighbors = $neighbors;
        $this->liveNeighborsCount = $this->countLiveNeighbors();
    }

    /**
     * @return bool
     */
    public function isPopulated() : bool
    {
        return $this->liveNeighborsCount > 0;
    }

    /**
     * @return bool
     */
    public function providesLivingConditions() : bool
    {
        if (!$this->isPopulated()) {
            return false;
        }

        return $this->cell->hasSuitableLivingConditions($this->liveNeighborsCount);
    }

    /**
     * @return array
     */
    public function listNeighborsPositions() : array
    {
        $positions = [];

        foreach ($this->neighbors as $x => $neighborsOnRow) {
            foreach ($neighborsOnRow as $y => $neighbor) {
                $positions[] = new Coordinates($x, $y);
            }
        }

        return $positions;
    }

    /**
     * @return int
     */
    private function countLiveNeighbors() : int
    {
        $liveNeighbors = 0;

        foreach ($this->neighbors as $x => $neighborsOnRow) {
            foreach ($neighborsOnRow as $y => $neighbor) {
                if ($this->neighbors[$x][$y]->isAlive()) {
                    $liveNeighbors++;
                }
            }
        }

        return $liveNeighbors;
    }
}