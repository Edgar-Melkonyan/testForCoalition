<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProduct;
use Request;

class ProductController extends Controller
{

    private $jsnonFile;

    public function __construct()
    {
        if (\Storage::disk('local')->exists('product.json')) {
            $file = \Storage::disk('local')->get('product.json');
            $json = json_decode($file, true);
        } else {
            $json = ['products' => []];
        }
        $this->jsnonFile = $json;
    }

    public function index()
    {
        return view('form');
    }

    public function storeProduct(StoreProduct $storeProduct)
    {
        $request = Request::except('_token');
        $request['dateTime'] = date("Y-m-d H:i:s");
        $json = $this->jsnonFile;
        array_push($json['products'], $request);
        $result = json_encode($json, true);
        \Storage::disk('local')->put('product.json', $result);
    }

    public function getJsonData()
    {
        $json_data = $this->jsnonFile;
        $sum = 0;
        if (!empty($json_data['products'])) {
            for ($i = 0; $i < count($json_data['products']); $i++) {
                $json_data['products'][$i]['total'] = $json_data['products'][$i]['quantity'] * $json_data['products'][$i]['price'];
                $sum += $json_data['products'][$i]['total'];
            }
            usort($json_data['products'], function($a, $b) {
                $dt1 = strtotime($a['dateTime']);
                $dt2 = strtotime($b['dateTime']);
                return $dt2 - $dt1;
            });
            $json_data['sum'] = $sum;
        }
        return response()->json($json_data);
    }
}