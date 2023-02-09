<?php

namespace Ulco\movement;

use Ulco\enums\RoverCommandEnum;
use Ulco\enums\RoverDirectionEnum;
use Ulco\Mars;
use Ulco\Rover;

/**
 * Turn right movement
 */
class TurnRightMovement extends Movement
{

    public function move(Rover $rover, Mars $planet): void
    {
       switch ($rover->getDirection()) {
            case RoverDirectionEnum::North:
                $rover->setDirection(RoverDirectionEnum::East);
                break;
            case RoverDirectionEnum::South:
                $rover->setDirection(RoverDirectionEnum::West);
                break;
            case RoverDirectionEnum::East:
                $rover->setDirection(RoverDirectionEnum::South);
                break;
            case RoverDirectionEnum::West:
                $rover->setDirection(RoverDirectionEnum::North);
                break;
        }
    }

    public function getType(): string
    {
        return RoverCommandEnum::TURN_RIGHT;
    }
}