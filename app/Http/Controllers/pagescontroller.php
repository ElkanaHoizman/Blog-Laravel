<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class pagescontroller extends Controller
{
    public function index(){
        $title='welcom to blogs';
        return view('pages.index')->with('title', $title);
    }
    public function about(){
        $title='about us';
        return view('pages.about')->with('title', $title);
    }
    public function servces(){
        $data=array(
        'title'=>'servces',
        'servces'=>['web desing','progtamming','sed']
        );
        return view('pages.servces')->with( $data);
    }
}
