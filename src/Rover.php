<?php

declare(strict_types=1);

namespace Ulco;

class Rover
{
    private int $x;

    private int $y;

    private Mars $planet;

    public function __construct()
    {
    }

    public function getX(): int
    {
        return $this->x;
    }

    public function getY(): int
    {
        return $this->y;
    }

    public function getPlanet(): Mars
    {
        return $this->planet;
    }

    public function land(Mars $planet, int $x, int $y): void
    {
        $this->planet = $planet;
        $this->x = $x;
        $this->y = $y;
    }

}