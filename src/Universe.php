<?php

namespace GOL;

class Universe
{
    /**
     * @var PopulatedArea
     */
    private $populatedArea;

    /**
     * Universe constructor.
     * @param PopulatedArea $populatedArea
     */
    private function __construct(PopulatedArea $populatedArea)
    {
        $this->populatedArea = $populatedArea;
    }

    /**
     * @return Universe
     */
    public static function empty() : Universe
    {
        return new self(PopulatedArea::initEmpty());
    }

    /**
     * @return bool
     */
    public function isEmpty() : bool
    {
        return $this->populatedArea->isEmpty();
    }

    /**
     * @param Coordinates $position
     */
    public function putLiveCellAtPosition(Coordinates $position)
    {
        $this->populatedArea->addLiveCellAtPosition($position);
    }

    /**
     * @return Universe
     */
    public function tick() : Universe
    {
        if ($this->isEmpty()) {
            return $this;
        }

        $nextGeneration = self::empty();

        foreach ($this->populatedArea->listLiveCellsPositions() as $liveCellPosition) {
            $this->processPopulatedAreaAroundCellAtPosition($liveCellPosition, $nextGeneration);
        }

        return $nextGeneration;
    }

    /**
     * @param $cellPosition
     * @param Universe $nextGeneration
     */
    private function processPopulatedAreaAroundCellAtPosition(Coordinates $cellPosition, Universe $nextGeneration)
    {
        if ($this->populatedArea->isCellAtPositionAlreadyProcessed($cellPosition)) {
            return;
        }

        $cellNeighborhood = $this->populatedArea->buildNeighborhoodForCellAtPosition($cellPosition);

        if (!$cellNeighborhood->isPopulated()) {
            return;
        }

        if ($cellNeighborhood->providesLivingConditions()) {
            $nextGeneration->putLiveCellAtPosition($cellPosition);
        }

        foreach($cellNeighborhood->listNeighborsPositions() as $neighbor) {
            $this->processPopulatedAreaAroundCellAtPosition($neighbor, $nextGeneration);
        }
    }
}
