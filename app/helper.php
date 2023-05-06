<?php

function formatDate(string $date): string {
    return date('M j, Y', strtotime($date));
}


function convertAmountToFloat(string $amount): float {
    return (float) str_replace(['$', ','], '', $amount);
}



function formatDollarsAmount(float $amount): string
{
    return (isNegative($amount) ? '-' : '') . '$' . number_format(abs($amount), 2, '.', ',');
}

function isNegative(float $amount): bool {
    return $amount < 0;
}

