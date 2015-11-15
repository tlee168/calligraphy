<?php

namespace App\Http\Controllers;

use DB;
use File;
use Image;
use App\Product;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductRequest;
use Auth;

class ProductsController extends Controller
{
    public $rules = [
        'category_id' => 'required|integer',
        'user_id'     => 'required|integer',
        'title'       => 'required|min:3',
        'description' => 'required|min:20',
        'year'        => 'required|numeric|digits_between:3,4',
        'price'       => 'required',
        'availability' => 'integer',
        'image'       => 'required|image|mimes:jpeg,jpg,bmp,png,gif'
    ];

    public function index()
    {
        $products = \App\Product::latest('created_at')->get();
        return view('products.index', compact('products'));
    }

    public function show($id)
    {
        $product = \App\Product::findOrFail($id);
        //$public = public_path();

        // if (is_null($product)) {
        //     abort(404);
        // }
        // dd($product);
        return view('products.show', compact('product'));
    }

    public function create()
    {

        if (Auth::guest()) {
            return redirect('/auth/login');
        }
        else {
            //$categories = DB::table('categories')->lists('name');
            $categories = \App\Category::all();
            // $options = [];
            // foreach ($categories as $category) {
            //     $options[$category->id] = $category->name;
            // }
            //
            $options = \App\Category::lists('name', 'id');

            $tags = \App\Tag::lists('name', 'id');



            // $upload_max_size = ini_get('upload_max_filesize');
            // $post_max_size = ini_get('post_max_size');
            // return "upload_max_size=" . $upload_max_size . ", post_max_size=" . $post_max_size;
            return view('products.create', compact('options', 'tags'));
        }
    }

    // public function store(CreateProductRequest $request)
    // {

    //     $product = new Product;
    //     $product->category_id = $request->input('category_id');
    //     $product->title = $request->input('title');
    //     $product->description = $request->input('description');
    //     $product->price = $request->input('price');
    //     $product->availability = $request->input('availability');

    //     $image = $request->file('image');
    //     $filename = date('Y-m-d-H:i:s') . '-' . $image->getClientOriginalName();
    //     Image::make($image->getRealPath())
    //             ->resize(468, 249)
    //             ->save('img/products/' . $filename);
    //     $product->image = 'img/products/' . $filename;
    //     $product->save();
    //     return redirect('products');
    // }

    //this also works without the form request
    public function store(Request $request)
    {

        $this->validate($request, $this->rules);


        $this->createProduct($request);

        //dd($request->all());
        // $product = App\Product::create($request->all());

        // $product = new Product;
        // $product->category_id = $request->input('category_id');
        // $product->title = $request->input('title');
        // $product->description = $request->input('description');
        // $product->price = $request->input('price');
        // $product->availability = $request->input('availability');

        // $tagIds = $request->input('tag_list');

        // $image = $request->file('image');
        // $filename = date('Y-m-d-H:i:s') . '-' . $image->getClientOriginalName();
        // Image::make($image->getRealPath())
        //         ->resize(468, 249)
        //         ->save('img/products/' . $filename);
        //$product->image = 'img/products/' . $filename;

        // $newProduct = \App\Product::create([
        //     'category_id' => $request->input('category_id'),
        //     'title' => $request->input('title'),
        //     'description' => $request->input('description'),
        //     'price' => $request->input('price'),
        //     'availability' => $request->input('availability'),
        //     'image' => 'img/products/' . $filename
        //     ]);

        // update pivot table
        // $newProduct->tags()->attach($tagIds);
        // $product->save();

        session()->flash('flash_message', 'Your product has been created!');
        return redirect('products');
    }

    public function edit($id)
    {
        $product = \App\Product::findOrFail($id);
        $options = \App\Category::lists('name', 'id');
        $tags = \App\Tag::lists('name', 'id');

        $oldimage = $product->image;

        return view('products.edit', compact('product', 'options', 'tags', 'oldimage'));

    }

    public function destroy($id)
    {
        $product = \App\Product::find($id);
        if ($product) {
            File::delete($product->image);
            File::delete(str_replace('products/', 'products/sm/', $product->image));
            DB::table('products')->where('id', $id)->delete();
            return redirect('products');
        }

        return redirect('products')->with('message', 'Something went wrong');
    }

    public function update(Request $request, $id)
    {
        $product = \App\Product::findOrFail($id);

        // $image = $request->file('image');
        // $oldimage = $product->image;

        // $pos = strpos($oldimage, "||");
        // if ($pos !== false) {
        //     list($prefix, $oldname) = explode("||", $oldimage, 2);
        //     if ($oldname == $image->getClientOriginalName()) {
        //         // remove the existing file
        //         $fname = public_path() . '/' . $oldimage;
        //         if (file_exists($fname)) {
        //             unlink($fname);
        //         }
        //         $fname = public_path() . '/' . str_replace('products/', 'products/sm/',$oldimage);
        //         if (file_exists($fname)) {
        //             unlink($fname);
        //         }
        //     }
        // }

        // $filename = date('Y-m-d-H:i:s') . '||' . $image->getClientOriginalName();

        // $img = Image::make($image->getRealPath());
        // $width = $img->width();
        // $height = $img->height();
        //     // resize the image to a width of 320 (if width > height) and constrain aspect ratio (auto height)
        // $img->resize($width > $height?320:null, $width>$height?null:320, function ($constraint) {
        //             $constraint->aspectRatio();
        //         })
        //         ->save('img/products/' . $filename)
        //         ->resize(80,80)
        //         ->save('img/products/sm/' . $filename);

        // $product->image = 'img/products/' . $filename;

        $input = $request->input();
        $product->update($input);

        // $product->category_id =  $request->input('category_id');
        // $product->title = $request->input('title');
        // $product->description = $request->input('description');
        // $product->price = $request->input('price');
        // $product->availability = $request->input('availability');
        // $product->year = $request->input('year');
        // $product->update();

        $this->syncTags($product, $request->input('tag_list'));

        return redirect('products');
    }

    // sync up the tag list in the database
    protected function syncTags(Product $product, array $tags)
    {
        $product->tags()->sync($tags);
    }

    public function createProduct(Request $request)
    {

        $tagIds = $request->input('tag_list');

        $image = $request->file('image');
        $filename = date('Y-m-d-H:i:s') . '||' . $image->getClientOriginalName();
        $img = Image::make($image->getRealPath());
        $width = $img->width();
        $height = $img->height();
            // resize the image to a width of 320 (if width > height) and constrain aspect ratio (auto height)
        $img->resize($width > $height?320:null, $width>$height?null:320, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save('img/products/' . $filename)
                ->resize(80,80)
                ->save('img/products/sm/' . $filename);

        $input = $request->input();
        $input['image'] = 'img/products/' . $filename;

        // $product = \App\Product::create([
        //     'category_id' => $request->input('category_id'),
        //     'user_id' => Auth::user()->id,
        //     'year' => $request->year,
        //     'title' => $request->input('title'),
        //     'description' => $request->input('description'),
        //     'price' => $request->input('price'),
        //     'availability' => $request->input('availability'),
        //     'image' => 'img/products/' . $filename
        //     ]);
        $product = \App\Product::create($input);

        // update pivot table
        $this->syncTags($product, $tagIds);

        return $product;

    }
}
