<?php

declare(strict_types=1);

namespace Ulco;

use Ulco\enums\RoverDirectionEnum;

class Mars
{
    public array $map = [];

    private int $size;

    /**
     * Constructor
     * @param int $size
     */
    public function __construct(int $size)
    {
        $this->size = $size;

        // Init positions
        for ($x = 0; $x < $size; $x++) {
            for ($y = 0; $y < $size; $y++) {
                $this->map[$x][$y] = null;
            }
        }
    }

    /**
     * Gets radius
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * Gets position of an object
     * @param object $object
     * @return object
     */
    public function getPosition(object $object): object
    {
        foreach ($this->map as $x => $row) {
            foreach ($row as $y => $cell) {
                if ($cell != null && $cell->id === $object->id) {
                    return (object)[
                        'x' => $x,
                        'y' => $y,
                    ];
                }
            }
        }

        return (object)[
            'x' => null,
            'y' => null,
        ];
    }

    /**
     * Moves a rover forward
     * @param Rover $rover
     */
    public function moveForward(Rover $rover): void
    {
        $position = $this->getPosition($rover);

        $x = $position->x;
        $oldX = $x;
        $y = $position->y;
        $oldY = $y;

        switch ($rover->getDirection()) {
            case RoverDirectionEnum::North:
                $y++;
                break;
            case RoverDirectionEnum::East:
                $x++;
                break;
            case RoverDirectionEnum::South:
                $y--;
                break;
            case RoverDirectionEnum::West:
                $x--;
                break;
        }

        // Check if the rover is out of the map
        // If so, move it to the other side
        if ($x < 0) {
            $x = $this->size - 1;
        }

        if ($x >= $this->size) {
            $x = 0;
        }

        if ($y < 0) {
            $y = $this->size - 1;
        }

        if ($y >= $this->size) {
            $y = 0;
        }

        // Remove the rover from the map
        $this->map[$oldX][$oldY] = null;

        // Add the rover to the new position
        $this->map[$x][$y] = $rover;
    }

    /**
     * Moves a rover backward
     * @param Rover $rover
     */
    public function moveBackward(Rover $rover): void
    {
        $position = $this->getPosition($rover);

        $x = $position->x;
        $oldX = $x;
        $y = $position->y;
        $oldY = $y;

        switch ($rover->getDirection()) {
            case RoverDirectionEnum::North:
                $y--;
                break;
            case RoverDirectionEnum::East:
                $x--;
                break;
            case RoverDirectionEnum::South:
                $y++;
                break;
            case RoverDirectionEnum::West:
                $x++;
                break;
        }

        // Check if the rover is out of the map
        // If so, move it to the other side
        if ($x < 0) {
            $x = $this->size - 1;
        }

        if ($x >= $this->size) {
            $x = 0;
        }

        if ($y < 0) {
            $y = $this->size - 1;
        }

        if ($y >= $this->size) {
            $y = 0;
        }

        // Remove the rover from the map
        $this->map[$oldX][$oldY] = null;

        // Add the rover to the new position
        $this->map[$x][$y] = $rover;
    }
}