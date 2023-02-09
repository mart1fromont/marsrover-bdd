<?php

namespace Ulco\enums;

/**
 * Enum for rover directions
 */
enum RoverDirectionEnum
{
    case North;
    case South;
    case East;
    case West;
}

/**
 * Convert a string to a RoverDirectionEnum
 * @param string $direction
 * @return RoverDirectionEnum
 */
function toRoverDirectionEnum(string $direction): RoverDirectionEnum
{
    return match ($direction) {
        'N' => RoverDirectionEnum::North,
        'S' => RoverDirectionEnum::South,
        'E' => RoverDirectionEnum::East,
        'W' => RoverDirectionEnum::West,
        default => throw new \InvalidArgumentException('Invalid direction'),
    };
}