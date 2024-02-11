<?php

namespace App\GenerateDescription\Adapters\ProductUrlFetcher\SerperApiProductUrlFetcher;

use App\GenerateDescription\Adapters\ProductUrlFetcher\ProductUrlFetcher;
use App\GenerateDescription\Dto\ProductUrlFetcher\ProductUrlOfferDto;
use App\GenerateDescription\Dto\ProductUrlFetcher\ProductUrlOffersCollection;

class SerperApiProductUrlFetcher implements ProductUrlFetcher
{

    public function getUrlToProductOffers(string $productName): ProductUrlOffersCollection
    {
        $productsUrlJsonArray = $this->fetchProductUrlByApi($productName);
        $collection = new ProductUrlOffersCollection();

        if(isset($productsUrlJsonArray['organic'])) {
            foreach ($productsUrlJsonArray['organic'] as $productUrlJson) {
                $productUrlOfferDto = new ProductUrlOfferDto();

                $productUrlOfferDto->setUrl($productUrlJson['link']);
                $productUrlOfferDto->setTitle($productUrlJson['title']);

                $collection->add($productUrlOfferDto);
            }
        }

        return $collection;
    }

    public function fetchProductUrlByApi(string $productName): array
    {
        $json = '{
          "searchParameters": {
            "q": "WOL-BAR Figi Secretia Beżowe",
            "gl": "pl",
            "hl": "pl",
            "num": 10,
            "autocorrect": true,
            "page": 1,
            "type": "search",
            "engine": "google"
          },
          "organic": [
            {
              "title": "Wol-Bar Secretia Majtki figi modelujące, beżowy - Sklep Kontri.pl",
              "link": "https://www.kontri.pl/pl/products/wol-bar-secretia-majtki-figi-modelujace-bezowy-5999.html",
              "snippet": "Sprawdź Wol-Bar Secretia Majtki figi modelujące, beżowy w sklepie Kontri.pl ▻ Już od 113,99 zł ✔️ Dostawa gratis od 79 zł ✓ Wysyłka nawet w 24h!",
              "priceRange": "113,99 zł W magazynie",
              "position": 1
            },
            {
              "title": "Figi damskie Wolbar Secretia - wysokie, modelujące, beżowe",
              "link": "https://dobra-bielizna.pl/pl/p/Figi-damskie-Wolbar-Secretia-wysokie%2C-modelujace%2C-bezowe/10076",
              "snippet": "Opis. Wysokie figi damskie modelujące sylwetkę - spłaszczają brzuch, podkreślają linię talii. Dzięki zawartości micromodalu, bawełny i elastanu łączą funkcje ...",
              "rating": 5,
              "ratingCount": 63,
              "priceRange": "99,99 zł",
              "position": 2
            },
            {
              "title": "Secretia figi damskie Wol-Bar - beżowy (30597) - Rafjolka.pl",
              "link": "https://rafjolka.pl/product-pol-30597-Secretia-figi-damskie-Wol-Bar-bezowy.html",
              "snippet": "Secretia figi damskie Wol-Bar - beżowy · figi damskie · wyszczuplające · 30% micromodal, 30% bawełna, 40% elastan · Polski producent.",
              "rating": 5,
              "ratingCount": 1,
              "priceRange": "95,00 zł",
              "position": 3
            },
            {
              "title": "Wolbar figi damskie secretia - wolbar - Bielizna9.com",
              "link": "https://www.bielizna9.com/Wolbar-FIGI-DAMSKIE-SECRETIA-p27543",
              "snippet": "Wolbar FIGI DAMSKIE SECRETIA Wysokie figi damskie modelujące sylwetkę- spłaszczają brzuch ... Skład: Micromodal 30%, Bawełna 30%, Elastan 40%. Kolory: czarny, ...",
              "priceRange": "107,69 zł",
              "position": 4
            },
            {
              "title": "Figi Wolbar - Bielizna wyszczuplająca (korygująca) - Allegro.pl",
              "link": "https://allegro.pl/kategoria/bielizna-damska-bielizna-wyszczuplajaca-78717?string=figi%20wolbar",
              "snippet": "Kup Figi Wolbar w Bielizna wyszczuplająca ☝ taniej na Allegro.pl - Najwięcej ofert w jednym miejscu. Radość zakupów ⭐ 100% bezpieczeństwa dla każdej ...",
              "position": 5
            },
            {
              "title": "Wol-Bar Figi Secretia Beżowe - Ceny i opinie - Ceneo.pl",
              "link": "https://www.ceneo.pl/122470684",
              "snippet": "Secretia - wysokie figi modelujące wykonane z gładziej dzianiny. Model korygujący linię brzucha, talii i bioder, dyskretny.",
              "position": 6
            },
            {
              "title": "Wol-Bar Secretia Majtki Figi, Beżowy,M - Amazon.pl",
              "link": "https://www.amazon.pl/Wol-Bar-Secretia-Majtki-Figi-Be%C5%BCowy/dp/B07CZHPRNY",
              "snippet": "Wol-Bar Secretia Majtki Figi, Beżowy,M : Amazon.pl: Moda.",
              "rating": 3.7,
              "ratingCount": 59,
              "priceRange": "Od 88,89 zł do 119,00 zł",
              "position": 7
            },
            {
              "title": "Figi Wolbar Secretia S-2XL beżowy - A&J Style",
              "link": "https://ajstyle.pl/pl/p/Figi-Wolbar-Secretia-S-2XL-bezowy/231341",
              "snippet": "Wysokie figi damskie modelujące sylwetkę. - wysokiej jakości opinająca dzianina. - spłaszczają brzuch, podkreślają linię talii, wysmuklają biodra.",
              "priceRange": "116,00 zł",
              "position": 8
            },
            {
              "title": "Wol-Bar Secretia beżowy L Majtki figi modelujące - Ceny i opinie ...",
              "link": "https://www.ceneo.pl/150857752",
              "snippet": "Majtki marki Wol-Bar. Model Secretia. Produkt został wykonany z 40% elastan, 30% bawełna, 30% micromodal. Odzież modelująca. Produkt damski.",
              "position": 9
            },
            {
              "title": "Wol-bar secretia majtki - figi Kolor beżowy Rozmiar 42 (XL) - Jagna.pl",
              "link": "https://www.jagna.pl/laserowe/62574-figi-damskie-modelujace-z-wysokim-stanem-wol-bar-secretia.html",
              "snippet": "Wysokie figi modelujące sylwetkę- spłaszczają brzuch, podkreślają linię talii.- wysoki stan- płaskie szwy- krawędzie cięte laserowo- zawartość micromodalu, ...",
              "priceRange": "72,74 zł",
              "position": 10
            }
          ],
          "peopleAlsoAsk": [
            {
              "question": "Co to są majtki figi?",
              "snippet": "Figi to rodzaj damskich majtek bez nogawek, z gumką w górnej części. Figi istnieją w kilku wariantach: Pełne – mocno zabudowane, posiadające umiarkowane wcięcia i zasłaniające praktycznie całe pośladki. Rio charakteryzują się podwyższonym stanem oraz głębokimi wycięciami na udach.",
              "title": "Rodzaje majtek damskich – jak dobrać majtki do typu figury",
              "link": "https://moenasklep.pl/rodzaje-majtek-damskich/"
            },
            {
              "question": "Co to są figi brazylijskie?",
              "snippet": "Figi brazylijskie (inaczej brazyliany) to rodzaj majtek damskich, które szturmem podbiły serca Pań na całym świecie. Wszystko za sprawą uniwersalnego kroju, będącego pomiędzy klasycznymi figami damskich a stringami. Brazyliany charakteryzują się większą ekspozycją pośladków niż figi damskie.",
              "title": "Jaki rodzaj majtek damskich wybrać: figi, brazyliany czy stringi? - Promees",
              "link": "https://www.promees.pl/blog/jaki-rodzaj-majtek-damskich-wybrac-figi-brazyliany-czy-stringi"
            }
          ]
        }';

        return json_decode($json, true);
    }
}
