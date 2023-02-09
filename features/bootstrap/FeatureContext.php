<?php

declare(strict_types=1);

use Behat\Behat\Context\Context;
use Ulco\enums\MarsObjectTypeEnum;
use Ulco\Mars;
use Ulco\Rock;
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
        $this->rover = new Rover(1);
    }

    /**
     * @Given there is Mars of size :size
     */
    public function thereIsMarsOfSize(int $size): void
    {
        $this->mars = new Mars($size);
    }

    /**
     * @When I land the rover at :arg1, :arg2
     */
    public function iLandTheRoverAt(int $arg1, int $arg2): void
    {
        $this->rover->land($this->mars, $arg1, $arg2);
    }

    /**
     * @Then Rover should be in :x, :y
     */
    public function roverShouldBeIn(int $x, int $y): void
    {
        $position = $this->rover->getPlanet()->getPosition($this->rover);
        Assert::eq($position->x, $x);
        Assert::eq($position->y, $y);
    }

    /**
     * @Then I move the rover forward
     */
    public function iMoveTheRoverForward(): void
    {
        $this->rover->send([RoverCommandEnum::MOVE_FORWARD]);
    }

    /**
     * @Then I move the rover backward
     */
    public function iMoveTheRoverBackward(): void
    {
        $this->rover->send([RoverCommandEnum::MOVE_BACKWARD]);
    }

    /**
     * @When I turn the rover left
     */
    public function iTurnTheRoverLeft(): void
    {
        $this->rover->send([RoverCommandEnum::TURN_LEFT]);
    }

    /**
     * @When I turn the rover right
     */
    public function iTurnTheRoverRight(): void
    {
        $this->rover->send([RoverCommandEnum::TURN_RIGHT]);
    }

    /**
     * @Then Rover should be facing :arg1
     */

    public function roverShouldBeFacing(string $arg1): void
    {
        assert($this->rover->getDirection() === toRoverDirectionEnum($arg1));
    }

    /**
     * @Given there is a rock :id at :x, :y
     */
    public function thereIsARockAt(int $id, int $x, int $y): void
    {
        $this->mars->addObject(new Rock($id), $x, $y);
    }

    /**
     * @Then Rover should report rock at :x, :y
     */
    public function RoverShouldReportRock(int $x, int $y): void
    {
        $object = $this->mars->getObjectAt($x, $y);
        Assert::eq($object->getType(), MarsObjectTypeEnum::Rock);
    }

    /**
     * @When I move the rover forward :i times then turn left then backward :j times
     */
    public function iMoveTheRoverForwardTimesThenTurnLeftThenBackwardTimes(int $i, int $j): void
    {
            $orders = [];
            for ($k = 0; $k < $i; $k++) {
                $orders[] = RoverCommandEnum::MOVE_FORWARD;
            }
            $orders[] = RoverCommandEnum::TURN_LEFT;
            for ($k = 0; $k < $j; $k++) {
                $orders[] = RoverCommandEnum::MOVE_BACKWARD;
            }
            $this->rover->send($orders);
    }
}
