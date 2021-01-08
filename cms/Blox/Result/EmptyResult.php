<?php

namespace Blox\Result;

class EmptyResult implements ResultInterface
{

    public function jsonSerialize()
    {
        return [];
    }
}
