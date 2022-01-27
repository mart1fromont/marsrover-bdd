<?php

declare(strict_types=1);

namespace Ulco;

class Rover
{
    private float $x;

    private float $y;

    public function land(float $x, float $y): void
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function getPosition(): array
    {
        return ['x' => $this->x, 'y' => $this->y];
    }
}