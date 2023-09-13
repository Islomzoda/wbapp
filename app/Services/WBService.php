<?php

namespace App\Services;

use App\Models\WBProduct;
use Carbon\Carbon;

class WBService
{
        static public function importProducts($brand_id){
           $cards = WB::getProductList($brand_id);
           $data = [];
            foreach ($cards as $key => $card){
                $data[$key]['brand_id'] = $brand_id;
                $data[$key]['update_at'] = Carbon::parse($card['updateAt']);
                $data[$key]['vendor_code'] = $card['vendorCode'];
                $data[$key]['nm_id'] = $card['nmID'];
                $data[$key]['imt_id'] = $card['imtID'];
                $data[$key]['is_prohibited'] = $card['isProhibited'];
                $data[$key]['brand'] = $card['brand'];
                $data[$key]['object'] = $card['object'];
                $data[$key]['sizes'] = json_encode($card['sizes']);
                $data[$key]['media_files'] = json_encode($card['mediaFiles']);
                $data[$key]['colors'] = json_encode($card['colors']);
                $data[$key]['tags'] = json_encode($card['tags']);
            }
//            dd($data);
            WBProduct::upsert($data, ['vendorCode']);
        }
}
