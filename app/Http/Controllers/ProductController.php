<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = 'Products - Online Store';
        $viewData['subtitle'] = 'List of products';
        $viewData['products'] = Product::all();

        return view('product.index')->with('viewData', $viewData);
    }

    public function show(int $id): View
    {
        $viewData = [];
        $product = Product::findOrFail($id);
        $viewData['title'] = $product->name.' - Online Store';
        $viewData['subtitle'] = $product->name.' - Product information';
        $viewData['product'] = $product;

        return view('product.show')->with('viewData', $viewData);
    }

    public function save(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
        ]);

        dd($request->all());
        Product::create($request->only(['name', 'price']));

        return back();
    }

    public function create(): \Illuminate\View\View
    {
        $viewData = [];
        $viewData['title'] = 'Create Product';
        $viewData['subtitle'] = 'Add a new product';

        return view('product.create')->with('viewData', $viewData);
    }
}
