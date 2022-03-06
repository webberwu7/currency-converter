<?php

namespace App\Http\Controllers\API;

use App\Currency;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function convert(Request $request)
    {
        // 須限制amount 範圍
        $validator = Validator::make($request->all(), [
            'amount' => ['required', 'numeric'],
            'from' => ['required', 'string', 'in:TWD,JPY,USD'],
            'to' => ['required', 'string', 'in:TWD,JPY,USD'],
        ]);

        if ($validator->fails()) {
            return response()->json(['return_message' => $validator->errors()->first()], 400);
        }
        $reqData = $validator->validate();
        $currencies = $this->currencyModel->get()['currencies'];
        $answer = [
            'source_amount' => number_format(floatval($reqData['amount']), 2),
            'target_amount' => number_format(floatval($reqData['amount']) * $currencies[$reqData['from']][$reqData['to']], 2),
            'from' => $reqData['from'],
            'to' => $reqData['to'],
        ];

        return response()->json($answer, 200);
    }
}
