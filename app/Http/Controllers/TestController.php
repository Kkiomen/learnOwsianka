<?php

namespace App\Http\Controllers;

use App\GenerateDescription\Adapters\ProductUrlFetcher\ProductUrlFetcher;
use http\Client;
use Illuminate\Http\Request;

class TestController extends Controller
{

    public function __construct(
        private readonly ProductUrlFetcher $productUrlFetcher
    ){}

    public function test(Request $request)
    {
        $client = new Client();


        $productName = 'WOL-BAR Figi Secretia Beżowe';
        $productUrlOffersCollection = $this->productUrlFetcher->getUrlToProductOffers('iphone 12');

        foreach ($productUrlOffersCollection as $productUrlOffer) {

//            dd($response->get($productUrlOffer->getUrl()););
            $response = $client->request("GET", $productUrlOffer->getUrl());
            $html = $response->getBody();



            break;
        }
    }

}
