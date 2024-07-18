<?php

namespace App\Http\Controllers;

use App\GenerateDescription\Adapters\ProductUrlFetcher\ProductUrlFetcher;
use App\Service\CourseService;
use http\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
class TestController extends Controller
{

    public function __construct(
        private readonly ProductUrlFetcher $productUrlFetcher
    ){}

    public function test(Request $request)
    {

    }

    public function getFormattedAnswerString($letter) {
        // Tworzymy mapę odpowiadającą każdej literze na odpowiedni format
        $formats = [
            'a' => 'X1000',
            'b' => 'X0100',
            'c' => 'X0010',
            'd' => 'X0001'
        ];

        // Sprawdzamy czy podana litera jest kluczem w tablicy $formats
        if (array_key_exists($letter, $formats)) {
            return $formats[$letter];
        } else {
            return 'Invalid input'; // Zwracamy komunikat o błędzie dla niepoprawnego wejścia
        }
    }
}
