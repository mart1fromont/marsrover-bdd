<?php

declare(strict_types=1);

use Behat\Behat\Context\Context;
use Ulco\enums\RoverDirectionEnum;
use Ulco\Mars;
use Ulco\Rover;
use Ulco\enums\RoverCommandEnum;
use Webmozart\Assert\Assert;
use function Ulco\enums\toRoverDirectionEnum;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    private Rover $rover;
    private Mars $mars;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {

    }

    /**
     * @Given there is a rover
     */
    public function thereIsARover(): void
    {
        $this->rover = new Rover();
    }

    /**
     * @Given there is Mars
     */
    public function thereIsMars(): void
    {
        $this->mars = new Mars();
    }

    /**
     * @When I land the rover at :arg1, :arg2
     */
    public function iLandTheRoverAt(int $arg1, int $arg2): void
    {
        $this->rover->land($this->mars, $arg1, $arg2);
    }

    /**
     * @Then Rover should be in :arg1, ":arg2
     */
    public function roverShouldBeIn(int $arg1,int $arg2): void
    {
        Assert::eq($this->rover->getX(), $arg1);
        Assert::eq($this->rover->getY(), $arg2);
    }

    /**
     * @Then I move the rover forward
     */
    public function iMoveTheRoverForward(): void
    {
        $this->rover->send(RoverCommandEnum::MOVE_FORWARD);
    }

    /**
     * @Then I move the rover backward
     */
    public function iMoveTheRoverBackward(): void
    {
        $this->rover->send(RoverCommandEnum::MOVE_BACKWARD);
    }

    /**
     * @When I turn the rover left
     */
    public function iTurnTheRoverLeft(): void
    {
        $this->rover->send(RoverCommandEnum::TURN_LEFT);
    }

    /**
     * @When I turn the rover right
     */
    public function iTurnTheRoverRight(): void
    {
        $this->rover->send(RoverCommandEnum::TURN_RIGHT);
    }

    /**
     * @Then Rover should be facing :arg1
     */

    public function roverShouldBeFacing(string $arg1): void
    {
        assert($this->rover->getDirection() === toRoverDirectionEnum($arg1));
    }

    /**
     * @When I move the rover forward until it reaches the edge of the map
     */

    public function iMoveTheRoverForwardUntilItReachesTheEdgeOfTheMap()
    {
        for($i = 0; $i < ($this->rover->getPlanet()->getSize()[1]-$this->rover->getY()); $i++) {
            $this->rover->send(RoverCommandEnum::FORWARD);
        }
    }

    /**
     * @Given there is an obstacle at :arg1, :arg2
     */
    public function thereIsAnObstacleAt(int $arg1, int $arg2): void
    {
        $this->mars->addObstacle($arg1, $arg2);
    }

    /**
     * @Then Rover should report :arg1
     */
    public function RoverShouldReport (String $message): void
    {
        Assert::eq($this->rover->getObstacleMessage(), $message);
    }
}
