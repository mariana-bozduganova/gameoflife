<?php

namespace GOL;

interface Cell
{
    public function isAlive() : bool;

    public function hasSuitableLivingConditions(int $liveNeighborsCount) : bool;
}