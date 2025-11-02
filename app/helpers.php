<?php

if (!function_exists('formatPrice')) {
    function formatPrice($price)
    {
        return number_format($price, 2) . ' EGP'; // Assuming EGP as currency
    }
}
