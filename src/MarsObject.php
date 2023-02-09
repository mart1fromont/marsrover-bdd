<?php

namespace Ulco;

use Ulco\enums\MarsObjectTypeEnum;

abstract class MarsObject
{
    public int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * Gets id
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Gets type
     * @return MarsObjectTypeEnum
     */
    abstract public function getType(): MarsObjectTypeEnum;
}