<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function index()
    {
        $users = \App\User::all()->toArray();
        return view('users.index', compact('users'));

    }
    public function show($id)
    {
        $user = \App\User::find($id);
        //products will be array of product
        //$products = $user->products->toArray();
        //
        //products is array of product objects
        $products = $user->products->all();

        return view('users.show', compact('user', 'products'));
    }
}
