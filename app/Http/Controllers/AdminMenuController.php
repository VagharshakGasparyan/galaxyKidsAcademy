<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminMenuController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View
    {

        return view('admin.menu');
    }
    public function create(){

    }

    public function store(Request $request){

    }
    public function show($id){

    }
}
