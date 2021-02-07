<?php

namespace GOL;

class PopulatedArea
{
    /**
     * @var
     */
    private $liveCells;

    /**
     * @var array
     */
    private $processedCells = [];

    /**
     * @return PopulatedArea
     */
    public static function initEmpty() : PopulatedArea
    {
        return new self();
    }

    /**
     * @return bool
     */
    public function isEmpty() : bool
    {
        return is_null($this->liveCells);
    }

    /**
     * @param Coordinates $position
     */
    public function addLiveCellAtPosition(Coordinates $position)
    {
        $this->liveCells[$position->getX()][$position->getY()] = new LiveCell();
    }

    /**
     * @return array
     */
    public function listLiveCellsPositions()
    {
        $positionsWithinArea = [];

        foreach ($this->liveCells as $x => $cellsOnRow) {
            foreach ($cellsOnRow as $y => $cell) {
                $positionsWithinArea[] = new Coordinates($x, $y);
            }
        }

        return $positionsWithinArea;
    }

    /**
     * @param Coordinates $position
     * @return bool
     */
    public function isCellAtPositionAlreadyProcessed(Coordinates $position) : bool
    {
        foreach ($this->processedCells as $processedCellCoordinates) {
            if ($processedCellCoordinates->equals($position)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param Coordinates $position
     * @return CellNeighborhood
     */
    public function buildNeighborhoodForCellAtPosition(Coordinates $position) : CellNeighborhood
    {
        $neighbors = [];

        foreach ($position->getNeighbors() as $neighborPosition) {
            $neighbors[$neighborPosition->getX()][$neighborPosition->getY()] = $this->getCellAtPosition($neighborPosition);
        }

        $cellNeighborhood = new CellNeighborhood($this->getCellAtPosition($position), $neighbors);

        $this->markPositionProcessed($position);

        return $cellNeighborhood;
    }

    /**
     * @param Coordinates $position
     * @return Cell
     */
    private function getCellAtPosition(Coordinates $position) : Cell
    {
        if (!$this->positionIsOccupied($position)) {
            return new DeadCell();
        }

        return new LiveCell();
    }

    /**
     * @param Coordinates $position
     * @return bool
     */
    private function positionIsOccupied(Coordinates $position) : bool
    {
        return isset($this->liveCells[$position->getX()][$position->getY()]);
    }

    /**
     * @param Coordinates $position
     */
    private function markPositionProcessed(Coordinates $position)
    {
        $this->processedCells[] = $position;
    }
}
