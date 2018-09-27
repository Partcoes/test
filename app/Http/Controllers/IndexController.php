<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class IndexController extends Controller
{
    //
    public function index()
    {
        $data = DB::table('users')->paginate(5);
        return view('index.index',['data'=>$data]);
    }
    public function show()
    {
        $arr = [1,2,3,4,5,6];
        dd($arr);
    }
}
