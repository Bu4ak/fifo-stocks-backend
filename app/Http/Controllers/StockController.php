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
                'lot_size' => 'required|min:1',
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
        $stock = Stock::where('user_id', $request->user()->id)->where('id', $id)->with('entries')->first()->toArray();
        $entries = [];
        foreach ($stock['entries'] as $entry) {
            $entries[$entry['id']] = $entry;
        }
        $stock['entries'] = $entries;
        return $stock;
    }

    public function index(Request $request)
    {
        $result = [];
        foreach (Stock::where('user_id', $request->user()->id)->with('entries')->get()->toArray() as $item) {
            $entries = [];
            foreach ($item['entries'] as $entry) {
                $entries[$entry['id']] = $entry;
            }
            $item['entries'] = $entries;
            $result[$item['id']] = $item;
        }

        return $result;
    }
}
