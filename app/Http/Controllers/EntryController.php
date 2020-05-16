<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use Illuminate\Http\Request;

class EntryController extends Controller
{
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'count' => 'required|numeric',
                'amount' => 'required|numeric',
                'stock_id' => 'required',
            ]
        );
        $entry = new Entry();
        $entry->count = $request->get('count');
        $entry->stock_id = $request->get('stock_id');
        $entry->amount = $request->get('amount');
        $entry->save();

        return $entry;
    }
}
