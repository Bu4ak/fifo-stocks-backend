<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required|min:3',
                'ticker' => 'min:2',
            ]
        );
        $stock = new Stock();
        $stock->user_id = $request->user()->id;
        $stock->name = $request->get('name');
        $stock->ticker = $request->get('ticker');
        $stock->save();

        return $stock;
    }
}
