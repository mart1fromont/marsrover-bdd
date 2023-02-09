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
            case RoverCommandEnum::FORWARD:
                $this->moveForward();
                break;
            case RoverCommandEnum::BACKWARD:
                $this->moveBackward();
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
}