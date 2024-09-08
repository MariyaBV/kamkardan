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
    public static function calculateShipping(array $shippingData): array
    {
        $store_city = WC()->countries->get_base_city();
        $store_country = WC()->countries->get_base_country();

        $params = [
            'from-country' => $store_country,
            'from-city' => urlencode($store_city),
            'to-country' => $shippingData['to_country'],
            'to-city' => urlencode($shippingData['to_city']),
            'hsw' => isset($shippingData['hsw']) ? $shippingData['hsw'] : [0],
            'weights' => isset($shippingData['weights']) ? $shippingData['weights'] : [],
            'volumes' => isset($shippingData['volumes']) ? $shippingData['volumes'] : [],
            'quantities' => isset($shippingData['quantities']) ? $shippingData['quantities'] : [],
            'palletize' => isset($shippingData['palletize']) ? $shippingData['palletize'] : [0],
            'lathing' => isset($shippingData['lathing']) ? $shippingData['lathing'] : [0],
            'need-pickup' => isset($shippingData['need_pickup']) ? $shippingData['need_pickup'] : 0,
            'need-deliver' => isset($shippingData['need_deliver']) ? $shippingData['need_deliver'] : 1,
            'widget' => 'dostavka',
            'need-insuring' => isset($shippingData['need_insuring']) ? $shippingData['need_insuring'] : 1,
            'cargo-price' => isset($shippingData['cargo_price']) ? $shippingData['cargo_price'] : 0,
            'need-labeling' => isset($shippingData['need_labeling']) ? $shippingData['need_labeling'] : 0,
        ];
    }
}