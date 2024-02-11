<?php

namespace App\GenerateDescription\Adapters\ProductUrlFetcher;

use App\GenerateDescription\Dto\ProductUrlFetcher\ProductUrlOffersCollection;

interface ProductUrlFetcher
{
    public function getUrlToProductOffers(string $productName): ProductUrlOffersCollection;
    public function fetchProductUrlByApi(string $productName): array;
}
