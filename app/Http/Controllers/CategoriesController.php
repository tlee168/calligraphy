<?php

namespace App\Http\Controllers;

use DB;
use App\Category;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class CategoriesController extends Controller
{
    public  $rules = [
        'name' => 'required|min:2'
    ];

    public function __construct()
    {
        $this->beforeFilter('csrf', ['on' => 'post']);
    }

    public function index()
    {
        $categories = \App\Category::all();
        return view('categories.index', compact('categories'));
    }

    public function create() {

        return view('categories.create');

    }

    public function show($id)
    {

        $category = \App\Category::findOrFail($id);

        // get array of product object
        $products = $category->products->all();
        // products is array of product
        // $products = [];
        // if ($category) {
        //     $products = DB::table('products')->where('category_id', $category->id)->latest('created_at')->get();
        //     //dd($products);
        // }
        return view('categories.show', compact('category', 'products'));
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->rules);
        $category = new Category;
        $category->name = $request->input('name');
        $category->save();
        return redirect('categories');
    }
}
