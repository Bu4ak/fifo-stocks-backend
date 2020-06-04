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
                'ticker' => 'required|min:2',
                'lot_size' => 'required|gt:0',
            ]
        );
        $stock = new Stock();
        $stock->user_id = $request->user()->id;
        $stock->name = $request->get('name');
        $stock->ticker = strtoupper($request->get('ticker'));
        $stock->lot_size = $request->get('lot_size');
        $stock->save();
        $result = $stock->toArray();
        $result['entries'] = new \stdClass();

        return $result;
    }

    public function show($id, Request $request)
    {
        $stock = Stock::where('user_id', $request->user()->id)
            ->where('id', $id)
            ->with(
                [
                    'entries' => function ($q) {
                        $q->orderBy('created_at');
                    },
                ]
            )->first()->toArray();
        $entries = [];
        foreach ($stock['entries'] as $entry) {
            $entries[$entry['id']] = $entry;
        }
        $stock['entries'] = $entries;

        return $stock;
    }

    public function index(Request $request)
    {
        return Stock::where('user_id', $request->user()->id)->orderBy('created_at', 'desc')->get();
    }
}
