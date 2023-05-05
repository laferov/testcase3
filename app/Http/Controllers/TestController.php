<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TestController extends Controller
{
    public function index(Request $request) {
        $data = array (
            'title' => 'foo',
            'body' => 'bar',
            'userId' => 1,
        );

        var_dump($request->bearerToken());
        die();
        #dd('test');
        $url = 'https://test.laferov.ru/test.php';
        $url = 'https://jsonplaceholder.typicode.com/posts';
        $url = 'https://taxi.laferov.ru/api/user/1';
        #$response = Http::post('https://test.laferov.ru/test.php',['test'=>'test']);
        #$response = Http::withBody(json_encode($data),'application/json')->post($url);
        $response = Http::get($url);
        dd($response->json());
    }
}
