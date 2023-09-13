<?php

namespace App\Services;

use App\Models\WBProduct;
use App\Models\WBProductPossition;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Log;

class WBPossitionService
{
    static public function req($key, $page = 1, $products = []){

        try {
            $client = new Client();
            $request = new Request('GET', 'https://search.wb.ru/exactmatch/ru/common/v4/search?TestGroup=no_test&TestID=no_test&appType=1&curr=rub&dest=-1257786&query=' . $key . '&regions=80,38,83,4,64,33,68,70,30,40,86,75,69,1,66,110,48,22,31,71,114&resultset=catalog&sort=popular&spp=0&suppressSpellcheck=false&uclusters=0&page=' . $page);
            $res = $client->sendAsync($request)->wait();
            $data = json_decode($res->getBody(), true);
            $products = [...$products, ...$data['data']['products']];
            if ($page < 2){
               return  self::req($key, 2, $products);
            }
            return $products;
        } catch (\Exception $err){
            Log::error('Произошла ошибка при проверке позиции ключа по товару');
        }
    }
    static public function get($keys)
    {
        $brand_id = '';
        $skus = [];
        foreach ($keys as $key){
            if ($brand_id != $key['brand_id']){
                $brand_id = $key['brand_id'];
                $skus = self::brand_skus($brand_id);
            }
            $positions  = self::req($key['keyword']);
//            dd(array_chunk($positions, 50));
            foreach ($positions as $key_position => $position) {
                if (in_array($position['id'], $skus)){
                    $product = WBProduct::where('nm_id', $position['id'])->first();
                    WBProductPossition::create([
                        'brand_id' => $brand_id,
                        'sku' => $product['vendor_code'],
                        'keyword' => $key['keyword'],
                        'position' => $key_position,
                        'ads' => empty($position['log']) ? 0 : 1,
                        'position_date' => today()->format('d-m-Y')
                    ]);
                }
            }

        }
    }
   static public function test(){
        self::get([
            [
                'keyword' => 'тюль',
                'brand_id' => '310941799'
            ]
        ]);
    }
    static public function brand_skus($brand_id){
        return  WBProduct::where('brand_id', $brand_id)->pluck('nm_id')->toArray();
    }
}
