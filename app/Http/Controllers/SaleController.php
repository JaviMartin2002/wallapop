<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Category, Sale, Setting, Image};

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::where('isSold', false)->with('category', 'images')->get();
        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        $categories = Category::all();
        $maxFiles = Setting::where('name', 'maxFiles')->first()->maxFiles ?? 5;
        return view('sales.create', compact('categories', 'maxFiles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
            'product' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $sale = Sale::create($request->only(['category_id', 'user_id', 'product', 'description', 'price', 'image']));

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('sales');
                Image::create(['sale_id' => $sale->id, 'route' => $path]);
            }
        }

        return redirect()->route('sales.index')->with('success', 'Product created successfully!');
    }
}
