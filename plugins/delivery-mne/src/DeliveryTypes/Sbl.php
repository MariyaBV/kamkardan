<?php

namespace mne\DeliveryTypes;

use mne\Interfaces\DeliveryTypeInterface;
use mne\Trait\HasDelivery;
class Sbl implements DeliveryTypeInterface
{
    use HasDelivery;

    public function __construct()
    {
        self::setName('Sbl');
    }

    public static function getName(): string
    {
        return self::$name;
    }
    public static function calculateShipping(array $data): array
    {

    }
}