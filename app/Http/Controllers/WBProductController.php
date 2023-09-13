<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class WBProductController extends Controller
{
    static public function loadProducts($brand_id)
    {

        try {
            $client = new Client();
            $request = new Request('GET', 'https://catalog.wb.ru/sellers/catalog?appType=1&curr=rub&dest=-1257786&supplier=' . $brand_id);
            $res = $client->sendAsync($request)->wait();
            return json_decode($res->getBody(), true)['data']['products'];
        }catch (\Exception $e){
            return [];
        }

    }
}
