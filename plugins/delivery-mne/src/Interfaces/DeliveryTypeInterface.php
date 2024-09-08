<?php

namespace mne\Interfaces;

interface DeliveryTypeInterface
{
    public static function getName(): string;
    public static function calculateShipping(array $data): array;
}