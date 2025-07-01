<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\CurrencyConverter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class CurrencyConverterController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'currency_code' => 'required|string|size:3',
        ]);
        $baseCurrency = config('app.currency');
        $currency_code = $request->currency_code;

        $cacheKey = "currency_rate_" . $currency_code;

        $rate = Cache::get($cacheKey, 0);

        if (!$rate) {
            $converter = app('currency.converter');
            $rate = $converter->convert(
                $baseCurrency,
                $currency_code,
            );

            Cache::put($cacheKey, $rate, now()->addMinutes(60));
        }
        Session::put('currency_code', $currency_code);
        toastr()->success('Currency changed successfully.');
        return redirect()->back();
    }
}
