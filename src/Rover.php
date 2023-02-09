<?php

declare(strict_types=1);

namespace Ulco;

use Ulco\enums\MarsObjectTypeEnum;
use Ulco\enums\RoverCommandEnum;
use Ulco\enums\RoverDirectionEnum;
use Ulco\movement\BackwardMovement;
use Ulco\movement\ForwardMovement;
use Ulco\movement\TurnLeftMovement;
use Ulco\movement\TurnRightMovement;

class Rover extends MarsObject
{

    private array $movements;

    private RoverDirectionEnum $direction;

    private Mars $planet;


    public function __construct(int $id)
    {
        parent::__construct($id);
        $this->direction = RoverDirectionEnum::North;

        $this->movements = [
            0 => new ForwardMovement(),
            1 => new BackwardMovement(),
            2 => new TurnLeftMovement(),
            3 => new TurnRightMovement()
        ];
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

    public function setDirection(RoverDirectionEnum $direction): void
    {
        $this->direction = $direction;
    }

    public function getPlanet(): Mars
    {
        return $this->planet;
    }

    public function land(Mars $planet, int $x, int $y): void
    {
        $this->planet = $planet;

        $planet->map[$x][$y] = $this;
    }

    /**
     * Send a command to the rover
     * @param array $commands
     * @return void
     */
    public function send(array $commands): void
    {
        foreach ($commands as $command) {
            foreach ($this->movements as $movement) {
                if ($movement->getType() === $command) {
                    $movement->move($this, $this->getPlanet());
                    break;
                }
            }
        }
    }
}
