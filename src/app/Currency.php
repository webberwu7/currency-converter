<?php

namespace App;

use Illuminate\Support\Facades\Storage;

class Currency
{
    protected $currencies;
    public function __construct()
    {
        $json = Storage::disk('local')->get('currencies.json');
        $this->currencies = json_decode($json, true);
    }

    public function get()
    {
        return $this->currencies;
    }
}
