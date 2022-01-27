<?php

declare(strict_types=1);

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Ulco\Mars;
use Ulco\Rover;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    private ?Rover $rover = null;

    private ?Mars $mars = null;

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
    public function iLandTheRoverAt(float $x, float $y)
    {
        $this->rover->land($x, $y);
    }

    /**
     * @Then Rover should be in :arg1, ":arg2
     */
    public function roverShouldBeIn($x, $y)
    {
        \Webmozart\Assert\Assert::eq($this->rover->getPosition()['x'], $x);
        \Webmozart\Assert\Assert::eq($this->rover->getPosition()['y'], $y);
    }
}
