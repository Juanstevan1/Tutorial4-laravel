<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Product;


class ProductController extends Controller
{
    public static $products = [
        ["id"=>"1", "name"=>"TV", "description"=>"Best TV", "price"=>299],
        ["id"=>"2", "name"=>"iPhone", "description"=>"Best iPhone", "price"=>999],
        ["id"=>"3", "name"=>"Chromecast", "description"=>"Best Chromecast", "price"=>35],
        ["id"=>"4", "name"=>"Glasses", "description"=>"Best Glasses", "price"=>199]
    ];

    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = "Products - Online Store";
        $viewData['subtitle'] = "List of products";
        $viewData['products'] = Product::all(); 
        return view('product.index')->with("viewData", $viewData);
    }

    public function show(string $id): View | RedirectResponse
    {
        $id = (int) $id;
    
        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('home.index');
        }
        $viewData = [];
        $viewData["title"] = $product->name . " - Online Store";
        $viewData["subtitle"] = $product->name . " - Product information";
        $viewData["product"] = $product;
    
        return view('product.show')->with("viewData", $viewData);
    }

    public function create(): View
    {
        $viewData = [];
        $viewData["title"] = "Create product";

        return view('product.create')->with("viewData",$viewData);
    }

    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0.01'
        ]);
    
        // Guardar el producto en la base de datos
        Product::create([
            'name' => $request->input('name'),
            'description' => $request->input('description', ''),
            'price' => $request->input('price'),
        ]);
    
        // Redirigir a la vista de confirmación
        return redirect()->route('product.created');
    }
}
