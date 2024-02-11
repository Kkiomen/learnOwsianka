<?php

namespace App\GenerateDescription\Dto\ProductUrlFetcher;

use App\Core\Structure\Collection;

class ProductUrlOffersCollection extends Collection
{
    public function add($item): void
    {
        if(!$item instanceof ProductUrlOfferDto) {
            throw new \InvalidArgumentException('Item must be instance of ProductUrlOfferDto');
        }

        parent::add($item);
    }
}
