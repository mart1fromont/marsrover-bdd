<?php

declare(strict_types=1);

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Ulco\Mars;
use Ulco\Rover;
use Ulco\RoverCommandEnum;

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
        $rover = new Rover();
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
    public function iLandTheRoverAt($arg1, $arg2)
    {
        $this->rover->land($this->mars, $arg1, $arg2);
    }

    /**
     * @Then Rover should be in :arg1, ":arg2
     */
    public function roverShouldBeIn($arg1, $arg2)
    {
        assert($this->rover->getX() === $arg1);
        assert($this->rover->getY() === $arg2);
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
}
