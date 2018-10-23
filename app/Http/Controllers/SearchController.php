<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $sku = explode("\r\n", $request->input('sku'));

        $path      = file_get_contents(storage_path() . '/sku.json', true);
        $priceData = json_decode($path);
        $results   = [];

        foreach ($sku as $value) {
            $result = array_filter($priceData, function ($item) use ($value) {
                return $item->sku == $value;
            });

            usort($result, function ($first, $second) {
                return $first->price > $second->price;
            });

            $results[$value] = $result;
        }

        return view('search', compact('results'));
    }
}
