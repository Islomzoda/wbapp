<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Log;

class WB
{
    static public function req($prefix, $brand_id, $body = [], $method = 'POST', $type = 'FBS', $head = [])
    {
        try {
            $client = new Client();
            $market = \App\Models\WB::where('brand_id', $brand_id)->first();
            $header = [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => $type === 'FBS'  ?  $market->fbs_api_key : $market->fbo_api_key,
                ...$head
            ];
            $url = $type === 'FBS' ? config('services.wb.API_URL') . $prefix : config('services.wb.FBO_API_URL') . $prefix;
            switch (true) {
                case $method !== 'GET':
                    $req = new Request($method, $url, $header, json_encode($body));
                    break;
                default:
                    $req = new Request($method, $url, $header);
                    break;
            }
            $res = $client->sendAsync($req)->wait();
            return json_decode($res->getBody(), true);
        } catch (\Exception $e) {
            Log::info('голова', $header);
            Log::info(json_encode($body));
            Log::error($e);
            return false;
        }
    }


    static public function getProductList($brand_id){
        $body =  [
            'sort' => [
                'cursor' => [
                    'limit' => 1000
                ],
                'filter' => [
                    'withPhoto' => -1
                ]
            ]
        ];
        return self::req('/content/v1/cards/cursor/list', $brand_id, $body)['data']['cards'];
    }
}
