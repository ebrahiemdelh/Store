<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\CurrencyConverter\CurrencyConverter;
use Illuminate\Http\Request;

class CurrencyConverterController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'currency_code' => 'required|string|size:3',
        ]);

        session(['currency' => $request->currency_code]);

        $baseCurrency = config('app.base_currency');
        $converter = new CurrencyConverter(
            config('services.currency_converter.api_key'),
        );
        $converter->convert(
            $baseCurrency,
            $request->currency_code,
        ); 
        toastr()->success('Currency changed successfully.');

        return redirect()->back();
    }
}
