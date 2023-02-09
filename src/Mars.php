<?php

declare(strict_types=1);

namespace Ulco;

class Mars
{
    public array $map = [];

    private int $size;

    /**
     * Constructor
     * @param int $size
     */
    public function __construct(int $size)
    {
        $this->size = $size;

        // Init positions
        for ($x = 0; $x < $size; $x++) {
            for ($y = 0; $y < $size; $y++) {
                $this->map[$x][$y] = null;
            }
        }
    }

    /**
     * Gets radius
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * Gets position of an object
     * @param object $object
     * @return object
     */
    public function getPosition(object $object): object
    {
        foreach ($this->map as $x => $row) {
            foreach ($row as $y => $cell) {
                if ($cell != null && $cell->id === $object->id) {
                    return (object)[
                        'x' => $x,
                        'y' => $y,
                        'type' => $cell->getType(),
                    ];
                }
            }
        }

        return (object)[
            'x' => null,
            'y' => null,
        ];
    }

    /**
     * Adds an object to the map
     * @param MarsObject $obstacle
     * @param int $x
     * @param int $y
     */
    public function addObject(MarsObject $obstacle, int $x, int $y): void
    {
        $this->map[$x][$y] = $obstacle;
    }

    /**
     * Gets the object at a position
     * @param int $x
     * @param int $y
     * @return MarsObject|null
     */
    public function getObjectAt(int $x, int $y): ?MarsObject
    {
        return $this->map[$x][$y];
    }
}