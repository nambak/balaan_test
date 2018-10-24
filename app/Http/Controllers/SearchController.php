<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

class SearchController extends Controller
{
    const SEARCH_URL = 'https://search.shopping.naver.com/search/all.nhn?query=';

    public function search(Request $request)
    {
        $sku = explode("\r\n", $request->input('sku'));

        $priceData = $this->getPriceData($sku);

        $results = $this->sortByLowPrice($priceData);

        return view('search', compact('results'));
    }

    protected function sortByLowPrice($data)
    {
        foreach ($data as $key => $item) {

            usort($item, function ($first, $second) {
                return $first['price'] > $second['price'];
            });

            $results[$key] = $item;
        }

        return $results;
    }

    protected function getPriceData(Array $sku) {
        $results = [];

        foreach($sku as $item) {
            $client = new Client;
            $response = $client->get(self::SEARCH_URL .$item);

            $crawler = new Crawler($response->getBody()->getContents());

            $result = $crawler->filter('ul.goods_list > li')->each(function (Crawler $node) use ($item) {
                return [
                    'sku' => $item,
                    'url' => $node->filter('.info a')->attr('href'),
                    'price' => $this->convertPrice($node->filter('.info .price em .num._price_reload')->text()),
                ];
            });

            $results[$item] = $result;
        }

        return $results;
    }

    protected function convertPrice($priceString)
    {
        return (int) str_replace(',', '', $priceString);
    }
}
