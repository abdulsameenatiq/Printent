<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class ProductControllerTest extends Controller
{
    public function showSingle($id)
    {
        // return $id;
        // return view("productDetail", );
        $data = [
            'productID' => 'pID',
            'productSlug' => 'pSlug',
        ];

        if (!array_key_exists($id, $data)) {
            // If not found, abort with a 404 status
            abort(404);
        }

        return view('productDetail', ['productData' => $data[$id]]);
        // return view('another', ["productData" => $id]);
    }
}