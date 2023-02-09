<?php

namespace Ulco\movement;

use Ulco\Mars;
use Ulco\Rover;

/**
 * Abstract class for movements
 */
abstract class Movement
{
    /**
     * Moves the rover on the planet
     *
     * @param Rover $rover
     * @param Mars $planet
     * @return void
     */
    public abstract function move(Rover $rover, Mars $planet) : void;

    /**
     * Gets type
     * @return string
     */
    public abstract function getType() : string;

    /**
     * Checks if the position is out of the map
     * If so, move to the other side
     *
     * @param int $x
     * @param int $y
     * @param Mars $planet
     * @return object
     */
    private function changePositionsForBounds(int $x, int $y, Mars $planet) : object {
        if ($x < 0) {
            $x = $planet->getSize() - 1;
        }

        if ($x >= $planet->getSize()) {
            $x = 0;
        }

        if ($y < 0) {
            $y = $planet->getSize() - 1;
        }

        if ($y >= $planet->getSize()) {
            $y = 0;
        }

        return (object)[
            'x' => $x,
            'y' => $y,
        ];
    }

    /**
     * Check for obstacles
     * @param int $x
     * @param int $y
     * @param Mars $planet
     * @return bool
     */
    private function hasObstacle(int $x, int $y, Mars $planet) : bool
    {
        return $planet->getObjectAt($x, $y) != null;
    }

    /**
     * Move the rover
     *
     * @param int $oldX
     * @param int $x
     * @param int $oldY
     * @param int $y
     * @param Rover $rover
     * @param Mars $planet
     */
    protected function moveRover(int $oldX, int $x, int $oldY, int $y, Rover $rover, Mars $planet) : void
    {
        $position = $this->changePositionsForBounds($x, $y, $planet);
        $x = $position->x;
        $y = $position->y;

        // If there is an obstacle, stop the rover
        if ($this->hasObstacle($x, $y, $planet)) {
            return;
        }

        // Remove the rover from the map
        $planet->map[$oldX][$oldY] = null;

        // Add the rover to the new position
        $planet->map[$x][$y] = $rover;
    }
}