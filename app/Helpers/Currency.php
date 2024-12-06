<?php

namespace App\Helpers;

use NumberFormatter;

class Currency {
    public static function format($amount,$currency=null) {
        $forrmatter=new NumberFormatter(config('app.locale'),NumberFormatter::CURRENCY);
        if($currency==null){
            $currency=config('app.currency','USD');
        }
        return $forrmatter->formatCurrency($amount,$currency);
    }
}