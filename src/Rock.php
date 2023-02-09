<?php

namespace Ulco;

use Ulco\enums\MarsObjectTypeEnum;

/**
 * Class Rock
 */
class Rock extends MarsObject
{

    public function __construct(int $id)
    {
        parent::__construct($id);
    }

    /**
     * Gets type
     * @return MarsObjectTypeEnum
     */
    public function getType(): MarsObjectTypeEnum
    {
        return MarsObjectTypeEnum::Rock;
    }
}