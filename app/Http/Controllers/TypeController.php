<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Type;

use Illuminate\Http\Request;

class TypeController extends Controller
{
        
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){
        //Categoryテーブルに入っているレコードを全て取得する
        $types = Type::all();
    
        return view('type.index')->with([
            'types' => $types,
        ]);
    }

    //種別一覧に遷移
        
    public function create(Request $request){

        return view('categories.create');
    
    }
}
