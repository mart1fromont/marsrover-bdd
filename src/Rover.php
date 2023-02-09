<?php

declare(strict_types=1);

namespace Ulco;

use Ulco\enums\MarsObjectTypeEnum;
use Ulco\enums\RoverCommandEnum;
use Ulco\enums\RoverDirectionEnum;

class Rover extends MarsObject
{

    private RoverDirectionEnum $direction;

    private Mars $planet;


    public function __construct(int $id)
    {
        parent::__construct($id);
        $this->direction = RoverDirectionEnum::North;
    }

    /**
     * Gets type
     * @return MarsObjectTypeEnum
     */
    public function getType(): MarsObjectTypeEnum
    {
        return MarsObjectTypeEnum::Rover;
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

        $planet->map[$x][$y] = $this;
    }

    /**
     * Send a command to the rover
     * @param string $command
     * @return void
     */
    public function send(array $commands) : void {
        foreach ($commands as $command) {
            switch ($command) {
                // Move forward
                case RoverCommandEnum::MOVE_FORWARD:
                    $this->planet->moveForward($this);
                    break;

                // Move backward
                case RoverCommandEnum::MOVE_BACKWARD:
                    $this->planet->moveBackward($this);
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
