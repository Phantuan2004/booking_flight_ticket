<?php
namespace App\Services;

class FlightPrice {
    public function flightPrice($flight, $adults, $childrens, $infants)
    {
        $adult_price = $flight->seat_class == 'phổ thông' ? $flight->price_economy : $flight->price_business * $adults;
        $child_price = $adult_price * 0.2 * $childrens;
        $infant_price = $adult_price * 0 * $infants;
        $tax_fee = $flight->seat_class == 'phổ thông' ? 50000 : 150000;
        $service_fee = $flight->seat_class == 'phổ thông' ? 20000 : 60000;
        $total_price = $adult_price + $child_price + $infant_price + $tax_fee + $service_fee;

        return compact('adult_price', 'child_price', 'infant_price', 'tax_fee', 'service_fee', 'total_price');
    }
}