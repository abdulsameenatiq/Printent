<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class NavbarController extends Controller
{
    public function categories()
    {
        // navbar links
        return [
            (object) ['url' => '/category1', 'text' => 'category1'],
            (object) ['url' => '/category2', 'text' => 'category2'],
            (object) ['url' => '/category3', 'text' => 'category3'],
            (object) ['url' => '/category4', 'text' => 'category4'],
            (object) ['url' => '/category5', 'text' => 'category5'],
        ];
    }
}