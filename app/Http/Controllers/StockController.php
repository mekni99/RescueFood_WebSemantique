<?php

namespace App\Http\Controllers;
use App\Models\Stock; // <-- This is the missing import

use Illuminate\Http\Request;

class StockController extends Controller
{

    public function index()
    {
        $items = Stock::all();
        return view('pages.stock', compact('items')); // Use 'items' instead of 'stocks'
    }

    public function create()
    {
        return view('stock.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'invoice_number' => 'required'
        ]);

        Stock::create($request->all());

        return redirect()->route('stock.index')->with('success', 'Stock created successfully.');
    }

    public function show(Stock $stock)
    {
        return view('stock.show', compact('stock'));
    }

    public function edit(Stock $stock)
    {
        return view('stock.edit', compact('stock'));
    }

    public function update(Request $request, Stock $stock)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'invoice_number' => 'required'
        ]);

        $stock->update($request->all());

        return redirect()->route('stock.index')->with('success', 'Stock updated successfully.');
    }

    public function destroy(Stock $stock)
    {
        $stock->delete();

        return redirect()->route('stock.index')->with('success', 'Stock deleted successfully.');
    }
}
