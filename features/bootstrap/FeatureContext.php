<?php

declare(strict_types=1);

use Behat\Behat\Context\Context;
use Ulco\enums\RoverDirectionEnum;
use Ulco\Mars;
use Ulco\Rover;
use Ulco\enums\RoverCommandEnum;
use Webmozart\Assert\Assert;

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
    public function thereIsARover()
    {
        $this->rover = new Rover();
    }

    /**
     * @Given there is Mars
     */
    public function thereIsMars()
    {
        $this->mars = new Mars();
    }

    /**
     * @When I land the rover at :arg1, :arg2
     */
    public function iLandTheRoverAt(int $arg1, int $arg2)
    {
        $this->rover->land($this->mars, $arg1, $arg2);
    }

    /**
     * @Then Rover should be in :arg1, ":arg2
     */
    public function roverShouldBeIn(int $arg1,int $arg2)
    {
        Assert::eq($this->rover->getX(), $arg1);
        Assert::eq($this->rover->getY(), $arg2);
    }

    /**
     * @Then I move the rover forward
     */
    public function iMoveTheRoverForward()
    {
        $this->rover->send(RoverCommandEnum::FORWARD);
    }

    /**
     * @Then I move the rover backward
     */
    public function iMoveTheRoverBackward()
    {
        $this->rover->send(RoverCommandEnum::BACKWARD);
    }

    /**
     * @When I turn the rover left
     */
    public function iTurnTheRoverLeft()
    {
        $this->rover->send(RoverCommandEnum::LEFT);
    }

    /**
     * @When I turn the rover right
     */
    public function iTurnTheRoverRight()
    {
        $this->rover->send(RoverCommandEnum::RIGHT);
    }

    /**
     * @Then Rover should be facing :arg1
     */

    public function roverShouldBeFacing(RoverDirectionEnum $arg1)
    {
        assert($this->rover->getDirection() === $arg1);
    }
}
