<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Type;

class TypeController extends Controller
{


    /* 会員一覧
    *＠param Request $request
     *@return Response
     *
     */

    
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 種別一覧
     */
    public function index()
    {
        // 種別一覧取得
        $types = Type::all();

        return view('type.index', compact('types'))->with([
            'types' => $types,
        ]);
    }
    
    /**
     * 種別登録
     */
    public function add(Request $request)
    {
        // POSTリクエストのとき
        if ($request->isMethod('post')) {
            // バリデーション
            $this->validate($request, [
                'name' => 'required|max:100',
            ]);

            // 商品登録
            Type::create([
                'name' => $request->name,
                'detail' => $request->detail,
            ]);

            return redirect('/types');
        }

        return view('Type.add');
    }

    /**
     * 種別編集ページへ移動
     */

    public function edit($edit_id)
    {   
    $edit = Type::find($edit_id);
    $type = Type::find($edit->item_id);
    $types = Type::all();
    return view('type.edit', ['edit' => $edit,'type' => $type, 'types' => $types,]);
    }

}