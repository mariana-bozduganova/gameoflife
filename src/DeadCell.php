<?php

namespace GOL;

class DeadCell implements Cell
{
    /**
     * @return bool
     */
    public function isAlive() : bool
    {
        return false;
    }

    /**
     * @param int $liveNeighborsCount
     * @return bool
     */
    public function hasSuitableLivingConditions(int $liveNeighborsCount) : bool
    {
        return $liveNeighborsCount === 3;
    }
}
