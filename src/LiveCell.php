<?php

namespace GOL;

class LiveCell implements Cell
{
    /**
     * @return bool
     */
    public function isAlive() : bool
    {
        return true;
    }

    /**
     * @param int $liveNeighborsCount
     * @return bool
     */
    public function hasSuitableLivingConditions(int $liveNeighborsCount) : bool
    {
        return $liveNeighborsCount === 2 || $liveNeighborsCount === 3;
    }
}
