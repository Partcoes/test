<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    //
    public function index()
    {
        return view('users.index');
    }
    public function store()
    {
        $data = $_POST;
        dd($data);
    }
    public function create()
    {

    }
    public function show($id)
    {
        dd($id);
    }
    public function edit($id)
    {
        return $id;
    }
}
