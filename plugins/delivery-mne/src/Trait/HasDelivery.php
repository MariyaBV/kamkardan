<?php

namespace mne\Trait;

trait HasDelivery
{
    static readonly string $name;

    public static function setName(string $name): void
    {
        self::$name = $name;
    }
}