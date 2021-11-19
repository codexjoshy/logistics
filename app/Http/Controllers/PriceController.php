<?php

namespace App\Http\Controllers;

use App\Models\Price;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    public function create(Request $request)
    {
        $prices =  Price::where('id',1)->first();
        $prices = $prices->distance_price;
        return view('admin.option.price', compact('prices'));
    }
    public function store(Request $request)
    {
        $data = $request->all();
        $result = [];
        foreach ($data as $key => $value) {
            $splitKey = explode('-', $key);
            if ($splitKey[0] == 'distance' ) {
                $result[] = [
                    "from"=> $value[0],
                    "to"=> $value[1],
                    "regular"=> $value[2],
                    "express"=> $value[3],
                ];
            }
        }

        Price::where('id', 1)->update(["distance_price"=>$result]);
        return back()->with('success', 'Prices Updated Successfully');
    }
}
