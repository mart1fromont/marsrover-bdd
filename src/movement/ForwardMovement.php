<?php

namespace Ulco\movement;

use Ulco\enums\RoverCommandEnum;
use Ulco\enums\RoverDirectionEnum;
use Ulco\Mars;
use Ulco\Rover;

/**
 * Forward movement
 */
class ForwardMovement extends Movement
{

    public function move(Rover $rover, Mars $planet): void
    {
        $position = $planet->getPosition($rover);

        $x = $position->x;
        $y = $position->y;
        $oldX = $x;
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

        $this->moveRover($oldX, $x, $oldY, $y, $rover, $planet);
    }

    public function getType(): string
    {
        return RoverCommandEnum::MOVE_FORWARD;
    }
}