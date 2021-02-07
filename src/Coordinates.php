<?php

namespace GOL;

class Coordinates
{
    /**
     * @var int
     */
    private $x;
    /**
     * @var int
     */
    private $y;

    /**
     * Coordinates constructor.
     * @param int $x
     * @param int $y
     */
    public function __construct(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public static function random()
    {
        return new self(rand(0, 100), rand(0, 100));
    }

    /**
     * @return int
     */
    public function getX() : int
    {
        return $this->x;
    }

    /**
     * @return int
     */
    public function getY() : int
    {
        return $this->y;
    }

    /**
     * @param Coordinates $other
     * @return bool
     */
    public function equals(Coordinates $other) : bool
    {
        return $this->x === $other->x && $this->y === $other->y;
    }

    /**
     * @return array
     */
    public function getNeighbors() : array
    {
        $neighborsCoordinates = [];

        $leftNeighborPosition = $this->y - 1;
        $rightNeighborPosition = $this->y + 1;
        $topNeighborPosition = $this->x - 1;
        $bottomNeighborPosition = $this->x + 1;

        for ($i = $topNeighborPosition; $i <= $bottomNeighborPosition; $i++) {
            for ($j = $leftNeighborPosition; $j <= $rightNeighborPosition; $j++) {
                $coordinates = new self($i, $j);

                if ($this->equals($coordinates)) {
                    continue;
                }

                $neighborsCoordinates[] = $coordinates;
            }
        }

        return $neighborsCoordinates;
    }
}