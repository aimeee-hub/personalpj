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
    $type = Type::find($edit->type_id);
    $types = Type::all();
    return view('type.edit', ['edit' => $edit,'type' => $type, 'types' => $types,]);
    }

        /* 種別情報の更新 */
        public function update(Request $request, $update_id)
        {
            // バリデーション
            $this->validate($request, [
                'name' => 'required|max:100',
                'detail' => 'required|max:255',
            ]);
        
    
            //商品情報の更新
            
            Type::find($update_id)->update([
                'name' => $request->input('name'),
                'detail' => $request->input('detail'),
            ]);
            return redirect('/types');
        }
    
    /* 商品削除 */
    public function destroy(Request $request, $delete_id){
        $type = Type::find($delete_id);
        $type->delete();
        return redirect('/types');
    }
}