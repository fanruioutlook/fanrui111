<?php

namespace App\Http\Controllers\Edu;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    public function index(){
        return view('edu.article.index');
    }
    public function create(){
        return view('edu.article.create');
    }
    public function store(Request $request){

        dd($request->all());
        return view('edu.article.store');
    }

}

