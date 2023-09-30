<?php

namespace App\Http\Controllers\Config\Lib;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class cfg extends Controller
{
    public $appId;
    public $appUid;
    public $secretKey;
    public $appBaseUrl;
    public $moyskladVendorApiEndpointUrl;
    public $moyskladJsonApiEndpointUrl;


    public function __construct()
    {
        $this->appId = '7e134454-8b75-4d4b-a0cf-c8fb3529a881';
        $this->appUid = 'uchotkassa.smartinnovations';
        $this->secretKey = "fUSZaC503DDeDCGA4z2f3Xww2KHXqKVwMHaP69sYAJStHY7VyqhQ7IRlU9rrP35JiKsJqZFvgLm8m851cx4AG0c6AAtR2Dg5zebJ46ihKkb2Sf1gj5U5BUspyBGvJM6r";
        $this->appBaseUrl = 'https://smartukassa.kz/';
        $this->moyskladVendorApiEndpointUrl = 'https://apps-api.moysklad.ru/api/vendor/1.0';
        $this->moyskladJsonApiEndpointUrl = 'https://api.moysklad.ru/api/remap/1.2';
    }


}
