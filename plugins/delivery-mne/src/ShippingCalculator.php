<?php

namespace mne;
use mne\Interfaces\DeliveryTypeInterface;
class ShippingCalculator
{
    private $strategy;
    public function __construct(DeliveryTypeInterface $strategy)
    {
        $this->strategy = $strategy;
    }

    public function calculate($cart)
    {
        return $this->strategy->calculateShipping($cart);
    }
}