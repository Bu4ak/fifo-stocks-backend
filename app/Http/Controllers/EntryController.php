<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use App\Models\Stock;
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
        $stock = Stock::where('user_id', $request->user()->id)
            ->where('id', $request->get('stock_id'))
            ->firstOrFail();

        $entry = new Entry();
        $entry->count = $request->get('count');
        $entry->stock_id = $stock->id;
        $entry->amount = $request->get('amount');
        $entry->save();

        return $entry;
    }

    public function delete(Request $request)
    {
        $this->validate(
            $request,
            [
                'count' => 'required|numeric',
                'stock_id' => 'required',
            ]
        );
        $stock = Stock::where('user_id', $request->user()->id)
            ->where('id', $request->get('stock_id'))
            ->with(
                [
                    'entries' => function ($q) {
                        $q->orderBy('created_at');
                    },
                ]
            )
            ->firstOrFail();
        $count = (int)$request->get('count');

        foreach ($stock->entries as $entry) {
            if ($entry->count === $count) {
                $entry->delete();
                return;
            }

            if ($count === 0) {
                return;
            }

            if ($entry->count < $count) {
                $count -= $entry->count;
                $entry->delete();
                continue;
            }

            if ($entry->count > $count) {
                $entry->count -= $count;
                $entry->save();
                return;
            }
        }

        return $request;
    }
}
