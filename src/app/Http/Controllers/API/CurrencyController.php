<?php

namespace App\Http\Controllers\API;

use App\Currency;
use App\Http\Controllers\Controller;


class CurrencyController extends Controller
{

    protected $currencyModel;

    public function __construct(Currency $currencyModel)
    {
        $this->currencyModel = $currencyModel;
    }

    public function getCurrencies()
    {
        return response()->json($this->currencyModel->get(), 200);
    }

}
