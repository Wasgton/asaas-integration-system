<?php

if (function_exists('format_money')) {
    function format_money($amount): string
    {
        return 'R$ ' . number_format((float)$amount, 2, ',', '.');
    }
}