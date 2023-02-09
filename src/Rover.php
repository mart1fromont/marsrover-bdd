<?php

declare(strict_types=1);

namespace Ulco;

use Ulco\enums\RoverCommandEnum;
use Ulco\enums\RoverDirectionEnum;

class Rover
{
    private int $x;

    private int $y;

    private RoverDirectionEnum $direction;

    private Mars $planet;

    public function __construct()
    {
        $this->direction = RoverDirectionEnum::North;
    }

    public function getX(): int
    {
        return $this->x;
    }

    public function getY(): int
    {
        return $this->y;
    }

    public function getDirection(): RoverDirectionEnum
    {
        return $this->direction;
    }

    public function getPlanet(): Mars
    {
        return $this->planet;
    }

    public function land(Mars $planet, int $x, int $y) : void
    {
        $this->planet = $planet;
        $this->x = $x;
        $this->y = $y;
    }

    /**
     * Send a command to the rover
     * @param string $command
     * @return void
     */
    public function send(string $command) : void {
        switch ($command) {
            // Move forward
            case RoverCommandEnum::MOVE_FORWARD:
                $this->moveForward();
                break;

            // Move backward
            case RoverCommandEnum::MOVE_BACKWARD:
                $this->moveBackward();
                break;

            // Turn left
            case RoverCommandEnum::TURN_LEFT:
                $this->turnLeft();
                break;

            // Turn right
            case RoverCommandEnum::TURN_RIGHT:
                $this->turnRight();
                break;
        }
    }

    /**
     * Moves the rover forward depending on its direction
     * @return void
     */
    private function moveForward() : void
    {
        switch ($this->direction) {
            case RoverDirectionEnum::North:
                $this->y++;
                break;
            case RoverDirectionEnum::South:
                $this->y--;
                break;
            case RoverDirectionEnum::East:
                $this->x++;
                break;
            case RoverDirectionEnum::West:
                $this->x--;
                break;
        }
    }

    /**
     * Moves the rover backward depending on its direction
     * @return void
     */
    private function moveBackward() : void
    {
        switch ($this->direction) {
            case RoverDirectionEnum::North:
                $this->y--;
                break;
            case RoverDirectionEnum::South:
                $this->y++;
                break;
            case RoverDirectionEnum::East:
                $this->x--;
                break;
            case RoverDirectionEnum::West:
                $this->x++;
                break;
        }
    }

    /**
     * Turns the rover left
     * @return void
     */
    private function turnLeft() : void
    {
        switch ($this->direction) {
            case RoverDirectionEnum::North:
                $this->direction = RoverDirectionEnum::West;
                break;
            case RoverDirectionEnum::South:
                $this->direction = RoverDirectionEnum::East;
                break;
            case RoverDirectionEnum::East:
                $this->direction = RoverDirectionEnum::North;
                break;
            case RoverDirectionEnum::West:
                $this->direction = RoverDirectionEnum::South;
                break;
        }
    }

    /**
     * Turns the rover right
     * @return void
     */
    private function turnRight() : void
    {
        switch ($this->direction) {
            case RoverDirectionEnum::North:
                $this->direction = RoverDirectionEnum::East;
                break;
            case RoverDirectionEnum::South:
                $this->direction = RoverDirectionEnum::West;
                break;
            case RoverDirectionEnum::East:
                $this->direction = RoverDirectionEnum::South;
                break;
            case RoverDirectionEnum::West:
                $this->direction = RoverDirectionEnum::North;
                break;
        }
    }
}
